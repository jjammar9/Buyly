<script setup>
import { ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { getProducts } from '../api.js'

const router = useRouter()
const route = useRoute()
const query = ref('')
const suggestions = ref([])
const show = ref(false)
let timer = null

watch(() => route.path, () => { show.value = false; query.value = '' })

watch(query, (val) => {
  clearTimeout(timer)
  const q = val.trim()
  if (q.length < 2) { suggestions.value = []; show.value = false; return }
  timer = setTimeout(async () => {
    const res = await getProducts({ search: q, per_page: 5 })
    suggestions.value = res.data || []
    show.value = suggestions.value.length > 0
  }, 250)
})

function select(product) {
  show.value = false
  query.value = ''
  router.push(`/product/${product.slug}`)
}

function handleSearch() {
  show.value = false
  const q = query.value.trim()
  if (q) {
    router.push(`/catalog?search=${encodeURIComponent(q)}`)
    query.value = ''
  } else {
    router.push('/catalog')
  }
}

function hide() {
  setTimeout(() => { show.value = false }, 200)
}
</script>

<template>
  <div class="relative w-full">
    <form role="search" class="relative flex items-center w-full h-12 bg-[#f6f6f6] border-[0.5px] border-[#999] rounded-[28px] shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] focus-within:bg-white max-md:h-10" @submit.prevent="handleSearch">
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
        @keydown.enter="handleSearch"
        @blur="hide"
        @focus="show = suggestions.value.length > 0"
      />
    </form>
    <Transition
      enter-active-class="transition-opacity duration-150"
      leave-active-class="transition-opacity duration-100"
      enter-from-class="opacity-0"
      leave-to-class="opacity-0"
    >
      <div v-if="show" class="absolute top-full left-0 right-0 mt-1 bg-white border border-[#e0e0e0] rounded-xl shadow-lg z-50 overflow-hidden">
        <button
          v-for="p in suggestions"
          :key="p.id"
          class="flex items-center gap-3 w-full px-4 py-3 text-left border-0 bg-transparent cursor-pointer hover:bg-[#f7f5f0] border-b border-[#f0f0f0] last:border-0"
          @mousedown.prevent="select(p)"
        >
          <img :src="p.image" alt="" class="w-10 h-10 rounded-lg object-cover shrink-0" />
          <div class="flex-1 min-w-0">
            <div class="text-[14px] font-medium text-[#222] truncate">{{ p.name }}</div>
            <div class="text-[12px] text-[#888]">${{ p.sale_price || p.price }}</div>
          </div>
        </button>
      </div>
    </Transition>
  </div>
</template>
