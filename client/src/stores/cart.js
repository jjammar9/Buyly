import { reactive, computed } from 'vue'
import { addToCart as apiAddToCart, updateCartItem as apiUpdateCartItem, removeFromCart as apiRemoveFromCart, clearCart as apiClearCart, getCart as apiGetCart } from '../api.js'

const key = 'buyly_cart'
const saved = JSON.parse(localStorage.getItem(key) || '[]')

const items = reactive(saved)

function save() {
  localStorage.setItem(key, JSON.stringify([...items]))
}

export function useCart() {
  async function loadFromServer() {
    const token = localStorage.getItem('token')
    if (!token) return
    try {
      const serverItems = await apiGetCart()
      items.splice(0, items.length, ...serverItems)
      save()
    } catch {}
  }

  function add(product) {
    const existing = items.find(i => i.id === product.id)
    if (existing) existing.qty++
    else items.push({ id: product.id, name: product.name, price: product.sale_price || product.price, image: product.image, unit: product.unit, qty: 1 })
    save()
    const token = localStorage.getItem('token')
    if (token) {
      apiAddToCart(product.id).catch(() => {})
    }
  }

  function remove(productId) {
    const idx = items.findIndex(i => i.id === productId)
    if (idx !== -1) { items.splice(idx, 1); save() }
    const token = localStorage.getItem('token')
    if (token) {
      const existing = items.find(i => i.id === productId)
      if (!existing) apiRemoveFromCart(productId).catch(() => {})
    }
  }

  function updateQty(productId, qty) {
    const item = items.find(i => i.id === productId)
    if (item) { item.qty = Math.max(1, qty); save() }
    const token = localStorage.getItem('token')
    if (token) {
      apiUpdateCartItem(productId, qty).catch(() => {})
    }
  }

  function clear() {
    items.splice(0); save()
    const token = localStorage.getItem('token')
    if (token) {
      apiClearCart().catch(() => {})
    }
  }

  const total = computed(() => items.reduce((sum, i) => sum + i.price * i.qty, 0))
  const count = computed(() => items.reduce((sum, i) => sum + i.qty, 0))

  return { items, add, remove, updateQty, clear, total, count, loadFromServer }
}
