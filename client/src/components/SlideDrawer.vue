<script setup>
import { ref } from 'vue'

const props = defineProps({
  open: {
    type: Boolean,
    default: false,
  },
  logoSrc: {
    type: String,
    default: '',
  },
})

const emit = defineEmits(['close'])

function close() {
  emit('close')
}
</script>

<template>
  <Teleport to="body">
    <Transition name="drawer">
      <div v-if="open" class="drawer-overlay" @click="close">
        <div class="drawer" @click.stop>
          <div class="drawer-header">
            <button class="drawer-close" @click="close">✕</button>
            <img v-if="logoSrc" :src="logoSrc" alt="Buyly" class="drawer-logo" />
          </div>
          <nav class="drawer-links">
            <slot />
          </nav>
        </div>
      </div>
    </Transition>
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
  padding: 24px 0 24px 0;
  box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
}

.drawer-enter-active {
  transition: opacity 0.3s ease;
}

.drawer-leave-active {
  transition: opacity 0.2s ease;
}

.drawer-enter-active .drawer {
  transition: transform 0.3s ease;
}

.drawer-leave-active .drawer {
  transition: transform 0.2s ease;
}

.drawer-enter-from {
  opacity: 0;
}

.drawer-leave-to {
  opacity: 0;
}

.drawer-enter-from .drawer {
  transform: translateX(-100%);
}

.drawer-leave-to .drawer {
  transform: translateX(-100%);
}

.drawer-header {
  display: flex;
  align-items: center;
  gap: 4px;
  position: relative;
  padding: 4px 24px 8px 24px;
  margin-bottom: 8px;
}

.drawer-close {
  position: absolute;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border: none;
  background: transparent;
  cursor: pointer;
  border-radius: 4px;
  color: #343538;
  font-size: 20px;
  flex-shrink: 0;
}

.drawer-close:hover {
  background: #f0f0f0;
}

.drawer-logo {
  height: 24px;
  display: block;
  flex-shrink: 0;
  margin-left: 40px;
}

.drawer-links {
  display: flex;
  flex-direction: column;
  gap: 4px;
  padding: 0;
}

.drawer-link {
  display: block;
  padding: 12px 16px 12px 0;
  color: #222;
  text-decoration: none;
  font-size: 15px;
  font-weight: 500;
  border-radius: 8px;
}



@media (max-width: 768px) {
  .drawer {
    width: 80%;
    min-width: unset;
    max-width: unset;
  }
}
</style>
