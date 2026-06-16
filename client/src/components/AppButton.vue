<script setup>
defineProps({
  variant: {
    type: String,
    default: 'primary',
  },
})
</script>

<template>
  <button
    class="px-[53px] h-12 rounded-[999px] text-[14px] font-semibold cursor-pointer border-0 whitespace-nowrap transition-colors duration-150 max-lg:px-7 max-md:px-[18px] max-md:h-10 max-md:text-[13px]"
    :class="variant === 'primary'
      ? 'bg-[#0a8a4a] text-white hover:bg-[#097a42]'
      : 'bg-white text-[#222] border border-[#999] hover:bg-[#f0f0f0]'"
    style="font-family: DM Sans, sans-serif"
  >
    <slot />
  </button>
</template>
