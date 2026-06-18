import { reactive, computed } from 'vue'
import { addToCart as apiAddToCart, updateCartItem as apiUpdateCartItem, removeFromCart as apiRemoveFromCart, clearCart as apiClearCart, getCart as apiGetCart } from '../api.js'

const key = 'buyly_cart'
const saved = JSON.parse(localStorage.getItem(key) || '[]')

const items = reactive(saved)
const token = () => localStorage.getItem('token')

function save() {
  localStorage.setItem(key, JSON.stringify([...items]))
}

let loaded = false

export function useCart() {
  async function loadFromServer() {
    if (!token()) return
    try {
      const serverItems = await apiGetCart()
      items.splice(0, items.length, ...serverItems)
      save()
    } catch {}
    loaded = true
  }

  async function add(product) {
    if (token()) {
      try {
        await apiAddToCart(product.id)
        await loadFromServer()
        return
      } catch {}
    }
    const existing = items.find(i => i.id === product.id)
    if (existing) existing.qty++
    else items.push({ id: product.id, name: product.name, price: product.sale_price || product.price, image: product.image, unit: product.unit, qty: 1 })
    save()
  }

  async function remove(productId) {
    if (token()) {
      try {
        await apiRemoveFromCart(productId)
        const idx = items.findIndex(i => i.id === productId)
        if (idx !== -1) items.splice(idx, 1)
        save()
        return
      } catch {}
    }
    const idx = items.findIndex(i => i.id === productId)
    if (idx !== -1) { items.splice(idx, 1); save() }
  }

  async function updateQty(productId, qty) {
    if (token()) {
      try {
        await apiUpdateCartItem(productId, qty)
        const item = items.find(i => i.id === productId)
        if (item) item.qty = qty
        save()
        return
      } catch {}
    }
    const item = items.find(i => i.id === productId)
    if (item) { item.qty = Math.max(1, qty); save() }
  }

  async function clear() {
    if (token()) {
      try {
        await apiClearCart()
      } catch {}
    }
    items.splice(0); save()
  }

  const total = computed(() => items.reduce((sum, i) => sum + i.price * i.qty, 0))
  const count = computed(() => items.reduce((sum, i) => sum + i.qty, 0))

  return { items, add, remove, updateQty, clear, total, count, loadFromServer }
}
