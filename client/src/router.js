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

const routes = [
  { path: '/', name: 'home', component: HomeView },
  { path: '/catalog', name: 'catalog', component: CatalogView },
  { path: '/catalog/:category', name: 'catalog-category', component: CatalogView },
  { path: '/cart', name: 'cart', component: CartView },
  { path: '/login', name: 'login', component: LoginView },
  { path: '/register', name: 'register', component: RegisterView },
  { path: '/profile', name: 'profile', component: ProfileView, meta: { requiresAuth: true } },
  { path: '/about', name: 'about', component: StaticPage },
  { path: '/careers', name: 'careers', component: StaticPage },
  { path: '/blog', name: 'blog', component: StaticPage },
  { path: '/press', name: 'press', component: StaticPage },
  { path: '/help', name: 'help', component: StaticPage },
  { path: '/returns-refunds', name: 'returns', component: StaticPage },
  { path: '/delivery', name: 'delivery', component: StaticPage },
  { path: '/contact', name: 'contact', component: StaticPage },
  { path: '/gift-cards', name: 'gifts', component: StaticPage },
  { path: '/membership', name: 'membership', component: StaticPage },
  { path: '/coupons', name: 'coupons', component: StaticPage },
  { path: '/accessibility', name: 'accessibility', component: StaticPage },
  { path: '/more-ways-to-shop', name: 'more-ways-to-shop', component: StaticPage },
  { path: '/categories', name: 'categories', component: StaticPage },
  { path: '/product/:slug', name: 'product', component: ProductView },
  { path: '/checkout', name: 'checkout', component: CheckoutView, meta: { requiresAuth: true } },
  { path: '/orders', name: 'orders', component: CheckoutView, meta: { requiresAuth: true } },
  { path: '/:pathMatch(.*)*', name: 'NotFound', component: () => import('./views/NotFoundView.vue') },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return { top: 0 }
  }
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  if (to.meta.requiresAuth && !token) next({ name: 'login', query: { redirect: to.fullPath } })
  else next()
})

export default router
