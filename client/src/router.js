import { createRouter, createWebHistory } from 'vue-router'
import HomeView from './views/HomeView.vue'
import CatalogView from './views/CatalogView.vue'
import CartView from './views/CartView.vue'
import LoginView from './views/LoginView.vue'
import RegisterView from './views/RegisterView.vue'
import ProfileView from './views/ProfileView.vue'
import StaticPage from './views/StaticPage.vue'
import ProductView from './views/ProductView.vue'
import CheckoutView from './views/CheckoutView.vue'
import OrdersView from './views/OrdersView.vue'

const routes = [
  { path: '/', name: 'home', component: HomeView, meta: { title: 'Home', description: 'Fresh groceries and everyday essentials delivered to your door.' } },
  { path: '/catalog', name: 'catalog', component: CatalogView, meta: { title: 'Catalog', description: 'Browse our selection of fresh groceries and essentials.' } },
  { path: '/catalog/:category', name: 'catalog-category', component: CatalogView, meta: { title: 'Catalog', description: 'Browse our selection of fresh groceries and essentials.' } },
  { path: '/cart', name: 'cart', component: CartView, meta: { title: 'Cart', description: 'View your shopping cart.' } },
  { path: '/login', name: 'login', component: LoginView, meta: { title: 'Log in' } },
  { path: '/register', name: 'register', component: RegisterView, meta: { title: 'Create account' } },
  { path: '/profile', name: 'profile', component: ProfileView, meta: { title: 'Profile', requiresAuth: true } },
  { path: '/about', name: 'about', component: StaticPage, meta: { title: 'About' } },
  { path: '/careers', name: 'careers', component: StaticPage, meta: { title: 'Careers' } },
  { path: '/blog', name: 'blog', component: StaticPage, meta: { title: 'Blog' } },
  { path: '/press', name: 'press', component: StaticPage, meta: { title: 'Press' } },
  { path: '/help', name: 'help', component: StaticPage, meta: { title: 'Help' } },
  { path: '/returns-refunds', name: 'returns', component: StaticPage, meta: { title: 'Returns & Refunds' } },
  { path: '/delivery', name: 'delivery', component: StaticPage, meta: { title: 'Delivery' } },
  { path: '/contact', name: 'contact', component: StaticPage, meta: { title: 'Contact' } },
  { path: '/gift-cards', name: 'gifts', component: StaticPage, meta: { title: 'Gift Cards' } },
  { path: '/membership', name: 'membership', component: StaticPage, meta: { title: 'Membership' } },
  { path: '/coupons', name: 'coupons', component: StaticPage, meta: { title: 'Coupons' } },
  { path: '/accessibility', name: 'accessibility', component: StaticPage, meta: { title: 'Accessibility' } },
  { path: '/more-ways-to-shop', name: 'more-ways-to-shop', component: StaticPage, meta: { title: 'More Ways to Shop' } },
  { path: '/categories', name: 'categories', component: StaticPage, meta: { title: 'Categories' } },
  { path: '/product/:slug', name: 'product', component: ProductView, meta: { title: 'Product' } },
  { path: '/checkout', name: 'checkout', component: CheckoutView, meta: { title: 'Checkout', requiresAuth: true } },
  { path: '/orders', name: 'orders', component: OrdersView, meta: { title: 'Order History', requiresAuth: true } },
  { path: '/:pathMatch(.*)*', name: 'NotFound', component: () => import('./views/NotFoundView.vue'), meta: { title: 'Page Not Found' } },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return { top: 0 }
  }
})

const defaultDescription = 'Fresh groceries and everyday essentials delivered to your door.'

router.afterEach((to) => {
  const title = to.meta?.title
  document.title = title ? `${title} — Buyly` : 'Buyly — Fresh groceries delivered'
  let meta = document.querySelector('meta[name="description"]')
  if (!meta) {
    meta = document.createElement('meta')
    meta.name = 'description'
    document.head.appendChild(meta)
  }
  meta.content = to.meta?.description || defaultDescription
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  if (to.meta.requiresAuth && !token) next({ name: 'login', query: { redirect: to.fullPath } })
  else next()
})

export default router
