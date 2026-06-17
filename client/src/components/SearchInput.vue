<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const query = ref('')

function submit() {
  const q = query.value.trim()
  router.push(q ? `/catalog?search=${encodeURIComponent(q)}` : '/catalog')
}
</script>

<template>
  <form role="search" class="relative flex items-center w-full h-12 bg-[#f6f6f6] border-[0.5px] border-[#999] rounded-[28px] shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] focus-within:bg-white max-md:h-10" @submit.prevent="submit">
    <button
      type="submit"
      aria-label="Search"
      class="absolute left-1 top-1/2 -translate-y-1/2 flex items-center justify-center w-10 h-10 border-0 bg-transparent cursor-pointer rounded-full hover:bg-[rgba(0,0,0,0.04)] max-md:w-9 max-md:h-9"
    >
      <svg width="24" height="24" viewBox="0 0 24 24" fill="#343538" aria-hidden="true" class="w-5 h-5 max-md:w-[18px] max-md:h-[18px]">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.496 17.618a8 8 0 1 1 2.121-2.121l3.944 3.942-2.122 2.122zM17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0"/>
      </svg>
    </button>
    <input
      v-model="query"
      id="search-bar-input"
      autocomplete="off"
      autocorrect="off"
      autocapitalize="none"
      aria-label="Search"
      placeholder="Search products and stores"
      class="flex-1 h-full border-0 bg-transparent text-[15px] outline-none text-black indent-[40px] pr-12 box-border placeholder:text-black max-md:text-[14px] max-md:indent-9 max-md:pr-9"
    />
  </form>
</template>
