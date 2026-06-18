import { ref, computed } from 'vue'
import { login as apiLogin, register as apiRegister, logout as apiLogout } from '../api.js'
import { useCart } from '../stores/cart.js'

const user = ref(JSON.parse(localStorage.getItem('user') || 'null'))
const token = ref(localStorage.getItem('token') || '')

export function useAuth() {
  async function login(email, password) {
    const data = await apiLogin(email, password)
    token.value = data.token
    user.value = data.user
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
    const { loadFromServer } = useCart()
    await loadFromServer()
  }

  async function register(name, email, password, password_confirmation) {
    const data = await apiRegister(name, email, password, password_confirmation)
    token.value = data.token
    user.value = data.user
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
    const { loadFromServer } = useCart()
    await loadFromServer()
  }

  async function logout() {
    try { await apiLogout() } catch {}
    token.value = ''
    user.value = null
    localStorage.removeItem('token')
    localStorage.removeItem('user')
  }

  return { user, token, login, register, logout, isLoggedIn: computed(() => !!token.value) }
}
