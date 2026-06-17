import { reactive, computed } from 'vue'

const key = 'buyly_cart'
const saved = JSON.parse(localStorage.getItem(key) || '[]')

const items = reactive(saved)

function save() {
  localStorage.setItem(key, JSON.stringify([...items]))
}

export function useCart() {
  function add(product) {
    const existing = items.find(i => i.id === product.id)
    if (existing) existing.qty++
    else items.push({ id: product.id, name: product.name, price: product.sale_price || product.price, image: product.image, unit: product.unit, qty: 1 })
    save()
  }

  function remove(productId) {
    const idx = items.findIndex(i => i.id === productId)
    if (idx !== -1) { items.splice(idx, 1); save() }
  }

  function updateQty(productId, qty) {
    const item = items.find(i => i.id === productId)
    if (item) { item.qty = Math.max(1, qty); save() }
  }

  function clear() { items.splice(0); save() }

  const total = computed(() => items.reduce((sum, i) => sum + i.price * i.qty, 0))
  const count = computed(() => items.reduce((sum, i) => sum + i.qty, 0))

  return { items, add, remove, updateQty, clear, total, count }
}
