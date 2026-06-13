<script setup>
import { ref } from 'vue'
import BuylyLogo from '../assets/Logo1.png'

const drawerOpen = ref(false)

function toggleDrawer() {
  drawerOpen.value = !drawerOpen.value
}
</script>

<template>
  <header class="nav-header">
    <div class="container">
      <div class="nav-inner">
        <div class="nav-left">
          <button class="hamburger" @click="toggleDrawer">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </button>
          <a href="/" class="logo-link">
            <img :src="BuylyLogo" alt="Buyly" class="logo-img" />
          </a>
        </div>
        <div class="nav-right">
          <button class="btn btn-login">Log In</button>
          <button class="btn btn-signup">Sign Up</button>
        </div>
      </div>
    </div>
  </header>

  <Teleport to="body">
    <div v-if="drawerOpen" class="drawer-overlay" @click="toggleDrawer">
      <div class="drawer" @click.stop>
        <div class="drawer-header">
          <span class="drawer-title">Menu</span>
          <button class="drawer-close" @click="toggleDrawer">✕</button>
        </div>
        <nav class="drawer-links">
          <a href="#" class="drawer-link">Home</a>
          <a href="#" class="drawer-link">Shop</a>
          <a href="#" class="drawer-link">Categories</a>
          <a href="#" class="drawer-link">My Account</a>
          <a href="#" class="drawer-link">Orders</a>
          <a href="#" class="drawer-link">Help</a>
        </nav>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
.nav-header {
  background: #fff;
  border-bottom: 1px solid #e8e8e8;
  font-family: var(--font-sans);
}

.nav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 0;
}

.nav-left {
  display: flex;
  align-items: center;
  gap: 16px;
}

.hamburger {
  display: flex;
  flex-direction: column;
  gap: 4px;
  padding: 6px;
  border: none;
  background: transparent;
  cursor: pointer;
}

.bar {
  width: 22px;
  height: 2.5px;
  background: #222;
  border-radius: 2px;
}

.logo-link {
  line-height: 0;
}

.logo-img {
  height: 36px;
  display: block;
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 12px;
}

.btn {
  padding: 10px 22px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  font-family: var(--font-sans);
  cursor: pointer;
  border: none;
  transition: background 0.15s;
}

.btn-login {
  background: transparent;
  color: #222;
}

.btn-login:hover {
  background: #f0f0f0;
}

.btn-signup {
  background: #166534;
  color: #fff;
}

.btn-signup:hover {
  background: #14532d;
}

/* Drawer */
.drawer-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1000;
  animation: fadeIn 0.2s;
}

.drawer {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 20%;
  min-width: 220px;
  max-width: 320px;
  background: #fff;
  z-index: 1001;
  padding: 24px;
  box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
  animation: slideIn 0.25s ease-out;
}

.drawer-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.drawer-title {
  font-size: 18px;
  font-weight: 700;
  color: #166534;
}

.drawer-close {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  color: #666;
  padding: 4px;
}

.drawer-links {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.drawer-link {
  display: block;
  padding: 12px 16px;
  color: #222;
  text-decoration: none;
  font-size: 15px;
  font-weight: 500;
  border-radius: 8px;
  transition: background 0.15s;
}

.drawer-link:hover {
  background: #f0f0f0;
  color: #166534;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideIn {
  from { transform: translateX(-100%); }
  to { transform: translateX(0); }
}
</style>
