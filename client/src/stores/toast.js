import { ref } from 'vue'

const toasts = ref([])
let id = 0

export function useToast() {
  function show(message, type = 'success', duration = 3500) {
    const i = ++id
    toasts.value.push({ id: i, message, type })
    setTimeout(() => { remove(i) }, duration)
  }

  function remove(id) {
    const idx = toasts.value.findIndex(t => t.id === id)
    if (idx !== -1) toasts.value.splice(idx, 1)
  }

  return { toasts, show, remove }
}
