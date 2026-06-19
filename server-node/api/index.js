const express = require('express')
const cors = require('cors')
const { Pool } = require('pg')
const bcrypt = require('bcryptjs')
const jwt = require('jsonwebtoken')

const app = express()
app.use(cors())
app.use(express.json())

const pool = new Pool({ connectionString: process.env.DATABASE_URL })
const JWT_SECRET = process.env.JWT_SECRET || 'buyly-dev-secret'

function auth(req, res, next) {
  const header = req.headers.authorization
  if (!header || !header.startsWith('Bearer ')) {
    return res.status(401).json({ message: 'Unauthenticated' })
  }
  try {
    const decoded = jwt.verify(header.split(' ')[1], JWT_SECRET)
    req.userId = decoded.userId
    next()
  } catch {
    return res.status(401).json({ message: 'Unauthenticated' })
  }
}

// ── Health ──
app.get('/api', (req, res) => res.json({ message: 'Buyly API' }))

// ── Categories ──
app.get('/api/categories', async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM categories ORDER BY name')
    res.json(rows)
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.get('/api/categories/:slug', async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM categories WHERE slug = $1', [req.params.slug])
    if (!rows[0]) return res.status(404).json({ message: 'Category not found' })
    res.json(rows[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

// ── Products ──
app.get('/api/products', async (req, res) => {
  try {
    const { search, category, sort, page = '1', per_page = '20' } = req.query
    const limit = Math.max(1, Math.min(parseInt(per_page) || 20, 50))
    const offset = (Math.max(1, parseInt(page) || 1) - 1) * limit
    const params = []
    const conditions = []

    if (search) { params.push(`%${search}%`); conditions.push(`p.name ILIKE $${params.length}`) }
    if (category) { params.push(category); conditions.push(`c.slug = $${params.length}`) }

    const where = conditions.length ? `WHERE ${conditions.join(' AND ')}` : ''

    let orderBy = 'p.id DESC'
    if (sort === 'price_asc') orderBy = 'p.price ASC'
    else if (sort === 'price_desc') orderBy = 'p.price DESC'
    else if (sort === 'name_asc') orderBy = 'p.name ASC'
    else if (sort === 'name_desc') orderBy = 'p.name DESC'
    else if (sort === 'newest') orderBy = 'p.id DESC'

    const countResult = await pool.query(`SELECT COUNT(*) FROM products p LEFT JOIN categories c ON c.id = p.category_id ${where}`, params)
    const total = parseInt(countResult.rows[0].count)
    params.push(limit)
    params.push(offset)

    const { rows } = await pool.query(
      `SELECT p.*, c.name AS category_name, c.slug AS category_slug
       FROM products p LEFT JOIN categories c ON c.id = p.category_id ${where}
       ORDER BY ${orderBy} LIMIT $${params.length - 1} OFFSET $${params.length}`, params)

    res.json({ data: rows, current_page: parseInt(page), last_page: Math.ceil(total / limit), per_page: limit, total })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.get('/api/products/featured', async (req, res) => {
  try {
    const { rows } = await pool.query(
      `SELECT p.*, c.name AS category_name, c.slug AS category_slug
       FROM products p LEFT JOIN categories c ON c.id = p.category_id
       ORDER BY RANDOM() LIMIT 8`)
    res.json(rows)
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.get('/api/products/:slug', async (req, res) => {
  try {
    const { rows } = await pool.query(
      `SELECT p.*, c.name AS category_name, c.slug AS category_slug
       FROM products p LEFT JOIN categories c ON c.id = p.category_id
       WHERE p.slug = $1`, [req.params.slug])
    if (!rows[0]) return res.status(404).json({ message: 'Product not found' })
    const row = rows[0]
    row.category = row.category_name ? { id: row.category_id, name: row.category_name, slug: row.category_slug } : null
    delete row.category_name; delete row.category_slug
    res.json(row)
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

// ── Auth ──
app.post('/api/register', async (req, res) => {
  try {
    const { name, email, password, password_confirmation } = req.body
    if (!name || !email || !password) return res.status(422).json({ message: 'Missing required fields' })
    if (password !== password_confirmation) return res.status(422).json({ message: 'Passwords do not match' })

    const exists = await pool.query('SELECT id FROM users WHERE email = $1', [email])
    if (exists.rows[0]) return res.status(422).json({ message: 'Email already registered' })

    const hash = await bcrypt.hash(password, 12)
    const { rows } = await pool.query(
      'INSERT INTO users (name, email, password, created_at, updated_at) VALUES ($1, $2, $3, NOW(), NOW()) RETURNING id, name, email',
      [name, email, hash])

    const token = jwt.sign({ userId: rows[0].id }, JWT_SECRET, { expiresIn: '30d' })
    res.json({ user: rows[0], token })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.post('/api/login', async (req, res) => {
  try {
    const { email, password } = req.body
    const { rows } = await pool.query('SELECT * FROM users WHERE email = $1', [email])
    if (!rows[0]) return res.status(422).json({ message: 'Invalid credentials' })

    const match = await bcrypt.compare(password, rows[0].password)
    if (!match) return res.status(422).json({ message: 'Invalid credentials' })

    const token = jwt.sign({ userId: rows[0].id }, JWT_SECRET, { expiresIn: '30d' })
    const { password: _, ...user } = rows[0]
    res.json({ user, token })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.post('/api/logout', auth, (req, res) => {
  res.json({ message: 'Logged out' })
})

app.get('/api/user', auth, async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT id, name, email, created_at, updated_at FROM users WHERE id = $1', [req.userId])
    if (!rows[0]) return res.status(404).json({ message: 'User not found' })
    res.json(rows[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.put('/api/user', auth, async (req, res) => {
  try {
    const { name, email, current_password, password } = req.body
    const { rows } = await pool.query('SELECT * FROM users WHERE id = $1', [req.userId])
    if (!rows[0]) return res.status(404).json({ message: 'User not found' })

    if (password) {
      if (!current_password) return res.status(422).json({ message: 'Current password required' })
      const match = await bcrypt.compare(current_password, rows[0].password)
      if (!match) return res.status(422).json({ message: 'Current password is incorrect' })
    }

    const updates = []
    const vals = []
    if (name) { updates.push(`name = $${vals.length + 1}`); vals.push(name) }
    if (email) { updates.push(`email = $${vals.length + 1}`); vals.push(email) }
    if (password) { updates.push(`password = $${vals.length + 1}`); vals.push(await bcrypt.hash(password, 12)) }
    updates.push(`updated_at = NOW()`)

    vals.push(req.userId)
    await pool.query(`UPDATE users SET ${updates.join(', ')} WHERE id = $${vals.length}`, vals)
    const { rows: updated } = await pool.query('SELECT id, name, email, created_at, updated_at FROM users WHERE id = $1', [req.userId])
    res.json(updated[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

// ── Orders ──
app.get('/api/orders', auth, async (req, res) => {
  try {
    const { rows: orders } = await pool.query(
      `SELECT * FROM orders WHERE user_id = $1 ORDER BY created_at DESC`, [req.userId])
    for (const order of orders) {
      const { rows: items } = await pool.query(
        'SELECT * FROM order_items WHERE order_id = $1', [order.id])
      order.items = items
    }
    res.json(orders)
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.get('/api/orders/:id', auth, async (req, res) => {
  try {
    const { rows } = await pool.query(
      'SELECT * FROM orders WHERE id = $1 AND user_id = $2', [req.params.id, req.userId])
    if (!rows[0]) return res.status(404).json({ message: 'Order not found' })
    const { rows: items } = await pool.query('SELECT * FROM order_items WHERE order_id = $1', [rows[0].id])
    rows[0].items = items
    res.json(rows[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.post('/api/orders', auth, async (req, res) => {
  try {
    const { items, address_line1, address_line2, city, state, zip, notes } = req.body
    if (!items || items.length === 0) return res.status(422).json({ message: 'Cart is empty' })

    const productIds = items.map(i => i.product_id)
    const { rows: products } = await pool.query('SELECT * FROM products WHERE id = ANY($1::int[])', [productIds])
    const productMap = Object.fromEntries(products.map(p => [p.id, p]))

    for (const item of items) {
      if (!productMap[item.product_id]) return res.status(422).json({ message: `Product ${item.product_id} not found` })
    }

    const total = items.reduce((sum, item) => sum + (parseFloat(productMap[item.product_id].price) * item.quantity), 0)
    const eta = new Date(Date.now() + 2 * 60 * 60 * 1000).toISOString()

    const { rows: order } = await pool.query(
      `INSERT INTO orders (user_id, status, total, address_line1, address_line2, city, state, zip, notes, delivery_eta, created_at, updated_at)
       VALUES ($1, 'confirmed', $2, $3, $4, $5, $6, $7, $8, $9, NOW(), NOW()) RETURNING *`,
      [req.userId, total.toFixed(2), address_line1, address_line2 || null, city, state, zip, notes || null, eta])

    for (const item of items) {
      const prod = productMap[item.product_id]
      await pool.query(
        `INSERT INTO order_items (order_id, product_id, product_name, product_image, price, quantity, created_at, updated_at)
         VALUES ($1, $2, $3, $4, $5, $6, NOW(), NOW())`,
        [order[0].id, item.product_id, prod.name, prod.image, prod.price, item.quantity])
    }

    await pool.query('DELETE FROM cart_items WHERE user_id = $1', [req.userId])
    const { rows: orderItems } = await pool.query('SELECT * FROM order_items WHERE order_id = $1', [order[0].id])
    order[0].items = orderItems
    res.json(order[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.patch('/api/orders/:id/progress', auth, async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM orders WHERE id = $1 AND user_id = $2', [req.params.id, req.userId])
    if (!rows[0]) return res.status(404).json({ message: 'Order not found' })

    const stages = ['confirmed', 'preparing', 'shipped', 'delivered']
    const idx = stages.indexOf(rows[0].status)
    if (idx === -1 || idx === stages.length - 1) return res.status(422).json({ message: 'Cannot progress further' })

    const next = stages[idx + 1]
    const { rows: updated } = await pool.query(
      `UPDATE orders SET status = $1, updated_at = NOW() WHERE id = $2 RETURNING *`, [next, req.params.id])
    const { rows: items } = await pool.query('SELECT * FROM order_items WHERE order_id = $1', [updated[0].id])
    updated[0].items = items
    res.json(updated[0])
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

// ── Cart ──
app.get('/api/cart', auth, async (req, res) => {
  try {
    const { rows } = await pool.query(
      `SELECT ci.*, p.name, p.price, p.image, p.slug, p.unit, p.sale_price
       FROM cart_items ci JOIN products p ON p.id = ci.product_id
       WHERE ci.user_id = $1 ORDER BY ci.created_at`, [req.userId])
    res.json(rows)
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.post('/api/cart/add', auth, async (req, res) => {
  try {
    const { product_id, quantity = 1 } = req.body
    const { rows: exists } = await pool.query(
      'SELECT * FROM cart_items WHERE user_id = $1 AND product_id = $2', [req.userId, product_id])
    if (exists[0]) {
      await pool.query('UPDATE cart_items SET quantity = quantity + $1 WHERE id = $2', [quantity, exists[0].id])
    } else {
      await pool.query('INSERT INTO cart_items (user_id, product_id, quantity, created_at, updated_at) VALUES ($1, $2, $3, NOW(), NOW())',
        [req.userId, product_id, quantity])
    }
    const { rows } = await pool.query('SELECT * FROM cart_items WHERE user_id = $1', [req.userId])
    res.json({ data: rows, message: 'Added to cart' })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.put('/api/cart/product/:productId', auth, async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM cart_items WHERE user_id = $1 AND product_id = $2', [req.userId, req.params.productId])
    if (!rows[0]) return res.status(404).json({ message: 'Item not found' })
    await pool.query('UPDATE cart_items SET quantity = $1, updated_at = NOW() WHERE id = $2', [req.body.quantity, rows[0].id])
    res.json({ message: 'Updated' })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.delete('/api/cart/product/:productId', auth, async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM cart_items WHERE user_id = $1 AND product_id = $2', [req.userId, req.params.productId])
    if (!rows[0]) return res.status(404).json({ message: 'Item not found' })
    await pool.query('DELETE FROM cart_items WHERE id = $1', [rows[0].id])
    res.json({ message: 'Removed' })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.delete('/api/cart', auth, async (req, res) => {
  try {
    await pool.query('DELETE FROM cart_items WHERE user_id = $1', [req.userId])
    res.json({ message: 'Cart cleared' })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

app.get('/api/cart/count', auth, async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT COUNT(*) FROM cart_items WHERE user_id = $1', [req.userId])
    res.json({ count: parseInt(rows[0].count) })
  } catch (e) {
    res.status(500).json({ message: e.message })
  }
})

const PORT = process.env.PORT || 3000
if (process.env.VERCEL !== '1') {
  app.listen(PORT, () => console.log(`Buyly API running on port ${PORT}`))
}

module.exports = app
