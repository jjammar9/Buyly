<script setup>
import { useToast } from '../stores/toast.js'

const { toasts, remove } = useToast()
</script>

<template>
  <div class="fixed top-4 right-4 z-[9999] flex flex-col gap-2.5 pointer-events-none">
    <div
      v-for="t in toasts"
      :key="t.id"
      class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg text-[14px] font-medium animate-[slideIn_0.25s_ease-out]"
      :class="t.type === 'success' ? 'bg-[#166534] text-white' : t.type === 'error' ? 'bg-[#dc2626] text-white' : 'bg-[#222] text-white'"
    >
      <svg v-if="t.type === 'success'" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
      <svg v-else-if="t.type === 'error'" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
      <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      <span class="flex-1">{{ t.message }}</span>
      <button class="bg-transparent border-0 text-white/70 cursor-pointer p-0.5 hover:text-white transition-colors" @click="remove(t.id)">&times;</button>
    </div>
  </div>
</template>

<style>
@keyframes slideIn {
  from { opacity: 0; transform: translateX(40px); }
  to   { opacity: 1; transform: translateX(0); }
}
</style>
