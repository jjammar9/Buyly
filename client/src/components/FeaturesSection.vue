<script setup>
const imageUrls = [
  'https://images.unsplash.com/photo-1542838132-92c53300491e?w=600&h=400&fit=crop',
  'https://images.unsplash.com/photo-1490818387583-1baba5e638af?w=600&h=400&fit=crop',
  'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=600&h=400&fit=crop'
]

const features = [
  {
    title: 'Choose what you want',
    text: 'Select items from your favorite grocery stores at Instacart.com or in the app. See real-time updates.'
  },
  {
    title: 'See real-time updates',
    text: 'Personal shoppers pick items with care. Chat as they shop and manage your order.'
  },
  {
    title: 'Get your items same-day',
    text: 'Pick a convenient time for you. Enjoy Instacart\u2019s 100% quality guarantee on every order.'
  }
]
</script>

<template>
  <section class="w-[71%] max-w-[1200px] mx-auto mt-[60px]" style="font-family: DM Sans, sans-serif">
    <h2 class="text-[28px] font-bold text-[#222] text-center mb-10">Grocery delivery you can count on</h2>
    <div class="flex gap-6 justify-center">
      <div v-for="(feature, i) in features" :key="i" class="flex-1 max-w-[350px] flex flex-col items-center text-center">
        <div class="w-full h-[200px] rounded-xl overflow-hidden bg-[#f0f0f0] mb-5">
          <img :src="imageUrls[i]" :alt="feature.title" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-[20px] font-bold text-[#222] mb-2">{{ feature.title }}</h3>
        <p class="text-[15px] leading-[1.5] text-[#555]">{{ feature.text }}</p>
      </div>
    </div>
  </section>
</template>
