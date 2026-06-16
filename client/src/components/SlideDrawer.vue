<script setup>
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
    <Transition
      enter-active-class="transition-opacity duration-300"
      leave-active-class="transition-opacity duration-200"
      enter-from-class="opacity-0"
      leave-to-class="opacity-0"
    >
      <div v-if="open" class="fixed inset-0 bg-black/30 z-[1000]" @click="close">
      </div>
    </Transition>
    <Transition
      enter-active-class="transition-transform duration-300 ease"
      leave-active-class="transition-transform duration-200 ease"
      enter-from-class="-translate-x-full"
      leave-to-class="-translate-x-full"
    >
      <div v-if="open" class="fixed top-0 left-0 bottom-0 w-[20%] min-w-[220px] max-w-[320px] bg-white z-[1001] py-6 shadow-[2px_0_12px_rgba(0,0,0,0.1)] max-md:w-[80%] max-md:min-w-0 max-md:max-w-none" @click.stop>
        <div class="flex items-center gap-1 relative px-6 pb-2 mb-2">
          <button class="absolute left-0 flex items-center justify-center w-9 h-9 border-0 bg-transparent cursor-pointer rounded hover:bg-[#f0f0f0] text-[#343538] text-xl shrink-0" @click="close">✕</button>
          <img v-if="logoSrc" :src="logoSrc" alt="Buyly" class="h-6 block shrink-0 ml-10" />
        </div>
        <nav class="flex flex-col gap-1 p-0">
          <slot />
        </nav>
      </div>
    </Transition>
  </Teleport>
</template>
