<script setup>
const categories = [
  'Fruits & Vegetables',
  'Meat & Seafood',
  'Dairy & Eggs',
  'Bakery',
  'Deli',
  'Beverages',
  'Snacks',
  'Pantry',
  'Frozen',
]
</script>

<template>
  <header class="nav-header">
    <div class="top-bar">
      <div class="logo-section">
        <span class="logo-text">Buyly</span>
      </div>
      <div class="search-section">
        <div class="search-bar">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
          <input type="text" placeholder="Search products..." class="search-input" />
        </div>
      </div>
      <div class="auth-section">
        <button class="btn btn-outline">Log In</button>
        <button class="btn btn-primary">Sign Up</button>
      </div>
    </div>
    <nav class="category-bar">
      <button
        v-for="category in categories"
        :key="category"
        class="category-link"
      >
        {{ category }}
      </button>
    </nav>
  </header>
</template>

<style scoped>
.nav-header {
  background: #fff;
  border-bottom: 1px solid #e5e7eb;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.top-bar {
  display: flex;
  align-items: center;
  gap: 24px;
  padding: 12px 24px;
  max-width: 1280px;
  margin: 0 auto;
}

.logo-section {
  flex-shrink: 0;
}

.logo-text {
  font-size: 28px;
  font-weight: 800;
  color: #6366f1;
  letter-spacing: -0.5px;
}

.search-section {
  flex: 1;
}

.search-bar {
  position: relative;
  max-width: 480px;
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  color: #9ca3af;
}

.search-input {
  width: 100%;
  padding: 10px 16px 10px 40px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  outline: none;
  background: #f9fafb;
  transition: border-color 0.2s;
}

.search-input:focus {
  border-color: #6366f1;
  background: #fff;
}

.auth-section {
  display: flex;
  gap: 8px;
  flex-shrink: 0;
}

.btn {
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  border: none;
  transition: background 0.2s;
}

.btn-outline {
  background: transparent;
  border: 1px solid #d1d5db;
  color: #374151;
}

.btn-outline:hover {
  background: #f3f4f6;
}

.btn-primary {
  background: #6366f1;
  color: #fff;
}

.btn-primary:hover {
  background: #4f46e5;
}

.category-bar {
  display: flex;
  gap: 4px;
  padding: 0 24px 12px;
  max-width: 1280px;
  margin: 0 auto;
  overflow-x: auto;
}

.category-link {
  padding: 6px 16px;
  border: none;
  background: #f3f4f6;
  color: #374151;
  font-size: 13px;
  font-weight: 500;
  border-radius: 20px;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s;
}

.category-link:hover {
  background: #e5e7eb;
}
</style>
