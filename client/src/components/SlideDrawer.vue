<script setup>
import { ref } from 'vue'

const props = defineProps({
  open: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['close'])

function close() {
  emit('close')
}
</script>

<template>
  <Teleport to="body">
    <div v-if="open" class="drawer-overlay" @click="close">
      <div class="drawer" @click.stop>
        <div class="drawer-header">
          <span class="drawer-title">Menu</span>
          <button class="drawer-close" @click="close">✕</button>
        </div>
        <nav class="drawer-links">
          <slot />
        </nav>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
.drawer-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1000;
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

@media (max-width: 768px) {
  .drawer {
    width: 80%;
    min-width: unset;
    max-width: unset;
  }
}
</style>
