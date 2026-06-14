<script setup>
defineProps({
  variant: {
    type: String,
    default: 'primary',
  },
})
</script>

<template>
  <button class="app-btn" :class="`app-btn--${variant}`">
    <slot />
  </button>
</template>

<style scoped>
.app-btn {
  padding: 0 53px;
  height: 48px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 600;
  font-family: var(--font-sans);
  cursor: pointer;
  border: none;
  transition: background 0.15s;
  white-space: nowrap;
}

.app-btn--primary {
  background: #0a8a4a;
  color: #fff;
}

.app-btn--primary:hover {
  background: #097a42;
}

.app-btn--secondary {
  background: #fff;
  color: #222;
  border: 1px solid #999;
}

.app-btn--secondary:hover {
  background: #f0f0f0;
}

@media (max-width: 1024px) {
  .app-btn {
    padding: 0 28px;
  }
}

@media (max-width: 768px) {
  .app-btn {
    padding: 0 18px;
    height: 40px;
    font-size: 13px;
  }
}
</style>
