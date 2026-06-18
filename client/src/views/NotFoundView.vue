<template>
  <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
    <svg class="w-24 h-24 text-gray-300 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
    <p class="text-xl text-gray-500 mb-8">Page not found</p>
    <router-link to="/" class="bg-[#166534] text-white px-8 py-3 rounded-xl font-semibold hover:bg-[#14532d] transition-colors">
      Go home
    </router-link>
  </div>
</template>
