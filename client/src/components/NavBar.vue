<script setup>
import { ref } from 'vue'
import BuylyLogo from '../assets/instacart-logo-color-6678cb82d531f8910d5ba270a11a7e9b56fc261371bda42ea7a5abeff3492e1c.svg'
import SearchInput from './SearchInput.vue'
import AppButton from './AppButton.vue'
import SlideDrawer from './SlideDrawer.vue'

const drawerOpen = ref(false)
const searchOpen = ref(false)

function toggleDrawer() {
  drawerOpen.value = !drawerOpen.value
}

function toggleSearch() {
  searchOpen.value = !searchOpen.value
}
</script>

<template>
  <nav class="nav-header">
    <div class="container">
      <div class="nav-inner">
        <div class="nav-left-group">
          <button data-testid="menu-button" aria-label="Open main menu" class="hamburger" @click="toggleDrawer">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path d="M20 6H4v2h16zM4 11h16v2H4zM4 16h16v2H4z"/>
            </svg>
          </button>
          <a href="/" class="logo-link">
            <img :src="BuylyLogo" alt="Buyly" class="logo-img" />
          </a>
        </div>
        <div class="search-section">
          <SearchInput />
        </div>
        <div class="nav-right">
          <button aria-label="Search" class="search-toggle" @click="toggleSearch">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M15.496 17.618a8 8 0 1 1 2.121-2.121l3.944 3.942-2.122 2.122zM17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0"/>
            </svg>
          </button>
          <AppButton variant="secondary" class="login-desktop">Log in</AppButton>
          <AppButton variant="primary" class="signup-desktop">Sign up</AppButton>
          <a href="#" class="login-mobile">Log in</a>
          <a href="#" class="signup-mobile">Sign up</a>
        </div>
      </div>
      <div class="mobile-search-panel" :class="{ 'is-open': searchOpen }">
        <SearchInput />
      </div>
    </div>
  </nav>

  <SlideDrawer :open="drawerOpen" @close="toggleDrawer">
    <a href="#" class="drawer-link">Home</a>
    <a href="#" class="drawer-link">Shop</a>
    <a href="#" class="drawer-link">Categories</a>
    <a href="#" class="drawer-link">My Account</a>
    <a href="#" class="drawer-link">Orders</a>
    <a href="#" class="drawer-link">Help</a>
  </SlideDrawer>
</template>

<style scoped>
.nav-header {
  background: #f7f5f0;
  border-bottom: 1px solid #e8e8e8;
  font-family: var(--font-sans);
}

.nav-inner {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 16px 0;
}

.nav-left-group {
  display: flex;
  align-items: center;
  gap: 4px;
  flex-shrink: 0;
}

.hamburger {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4px;
  margin-top: 4px;
  border: none;
  background: transparent;
  cursor: pointer;
  flex-shrink: 0;
  border-radius: 4px;
}

.hamburger:hover {
  background: #f0f0f0;
}

.logo-link {
  line-height: 0;
  flex-shrink: 0;
}

.logo-img {
  height: 24px;
  display: block;
}

.search-section {
  flex: 1;
  display: flex;
  max-width: 61%;
  margin-left: 24px;
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
  margin-left: auto;
}

.search-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border: none;
  background: transparent;
  cursor: pointer;
  border-radius: 50%;
}

.search-toggle:hover {
  background: #e8e6e1;
}

.login-desktop {
  display: block;
}

.login-mobile {
  display: none;
  font-size: 14px;
  font-weight: 600;
  color: #222;
  text-decoration: none;
  white-space: nowrap;
}

.login-mobile:hover {
  text-decoration: underline;
}

.signup-desktop {
  display: block;
}

.signup-mobile {
  display: none;
  font-size: 14px;
  font-weight: 600;
  color: #0a8a4a;
  text-decoration: none;
  white-space: nowrap;
}

.signup-mobile:hover {
  text-decoration: underline;
}

.mobile-search-panel {
  display: none;
  padding-bottom: 12px;
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

@media (max-width: 768px) {
  .nav-inner {
    gap: 10px;
    padding: 12px 0;
  }

  .search-section {
    display: none;
  }

  .search-toggle {
    display: flex;
  }

  .login-desktop {
    display: none;
  }

  .signup-desktop {
    display: none;
  }

  .login-mobile {
    display: block;
  }

  .signup-mobile {
    display: block;
  }

  .mobile-search-panel {
    display: block;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
  }

  .mobile-search-panel.is-open {
    max-height: 60px;
    padding-bottom: 12px;
  }

  .nav-right {
    gap: 8px;
  }
}
</style>
