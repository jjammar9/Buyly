const BASE = 'http://127.0.0.1:8000/api'

async function request(path, opts = {}) {
  const token = localStorage.getItem('token')
  const headers = { 'Content-Type': 'application/json', Accept: 'application/json', ...(token ? { Authorization: `Bearer ${token}` } : {}), ...opts.headers }
  const res = await fetch(`${BASE}${path}`, { ...opts, headers })
  if (!res.ok) {
    const body = await res.json().catch(() => ({}))
    throw new Error(body.message || `Request failed: ${res.status}`)
  }
  return res.json()
}

export function getCategories() { return request('/categories') }
export function getCategory(slug) { return request(`/categories/${slug}`) }
export function getProducts(params = {}) {
  const q = new URLSearchParams(params).toString()
  return request(`/products${q ? `?${q}` : ''}`)
}
export function getFeaturedProducts() { return request('/products/featured') }
export function getProduct(slug) { return request(`/products/${slug}`) }

export function login(email, password) {
  return request('/login', { method: 'POST', body: JSON.stringify({ email, password }) })
}
export function register(name, email, password, password_confirmation) {
  return request('/register', { method: 'POST', body: JSON.stringify({ name, email, password, password_confirmation }) })
}
export function logout() {
  return request('/logout', { method: 'POST' })
}
export function getUser() {
  return request('/user')
}
export function updateUser(data) {
  return request('/user', { method: 'PUT', body: JSON.stringify(data) })
}
