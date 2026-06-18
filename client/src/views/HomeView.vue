<script setup>
import { ref } from 'vue'
import NavBar from '../components/NavBar.vue'
import HeroSection from '../components/HeroSection.vue'
import StoreCarousel from '../components/StoreCarousel.vue'
import TrustSection from '../components/TrustSection.vue'
import FeaturesSection from '../components/FeaturesSection.vue'
import FaqSection from '../components/FaqSection.vue'
import FooterSection from '../components/FooterSection.vue'
import deliveryTruck from '../assets/delivery_truck-BvY4lSkI.svg'

const email = ref('')
const subscribed = ref(false)

function subscribe() {
  if (email.value.trim()) {
    subscribed.value = true
    email.value = ''
  }
}
</script>

<template>
  <div>
    <NavBar />
    <HeroSection />
    <StoreCarousel />
    <TrustSection />
    <FeaturesSection />

    <!-- Newsletter -->
    <section class="bg-[#f7f5f0] py-14 my-12">
      <div class="w-[71%] max-w-[900px] mx-auto text-center">
        <h2 class="text-[28px] font-bold text-[#222] mb-3">Stay in the loop</h2>
        <p class="text-[15px] text-[#555] mb-6 max-w-[500px] mx-auto">Sign up for exclusive deals, new arrivals, and delivery tips.</p>
        <div v-if="subscribed" class="text-[#166534] font-semibold text-[16px]">Thanks for subscribing!</div>
        <form v-else class="flex gap-3 max-w-[480px] mx-auto max-md:flex-col" @submit.prevent="subscribe">
          <input v-model="email" type="email" placeholder="Enter your email" class="flex-1 h-12 px-4 border border-[#ddd] rounded-lg text-[15px] outline-none focus:border-[#0a8a4a]" />
          <button type="submit" class="h-12 px-6 bg-[#0a8a4a] text-white text-[15px] font-semibold rounded-lg border-0 cursor-pointer hover:bg-[#097a42] whitespace-nowrap">Subscribe</button>
        </form>
      </div>
    </section>

    <!-- App download -->
    <section class="py-16">
      <div class="w-[75%] max-w-[1100px] mx-auto flex items-stretch rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.08)] max-md:flex-col">
        <div class="flex-1 flex flex-col justify-center px-10 py-12 max-md:px-6 max-md:py-8">
          <h2 class="text-[30px] font-bold text-[#222] leading-[1.2] mb-4 max-md:text-[24px]">Get fresh groceries<br />in minutes</h2>
          <p class="text-[15px] text-[#555] leading-relaxed mb-6 max-w-[420px]">Download the Buyly app for exclusive deals, real-time tracking, and the freshest selection delivered right to your door.</p>
          <div class="flex gap-3 max-md:flex-col">
            <a href="#" class="inline-flex items-center justify-center gap-2 h-12 px-5 bg-[#222] text-white rounded-lg no-underline text-[14px] font-semibold hover:bg-[#333]">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
              App Store
            </a>
            <a href="#" class="inline-flex items-center justify-center gap-2 h-12 px-5 bg-[#222] text-white rounded-lg no-underline text-[14px] font-semibold hover:bg-[#333]">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zM3.5 2.5v19l10-9.5zM14.5 12l-3.5 3.5L17.5 19l5-5zM17.5 5l-6.5 3.5L14.5 12l5-5z"/></svg>
              Google Play
            </a>
          </div>
        </div>
        <div class="w-[45%] bg-[#166534] flex items-center justify-center p-8 max-md:hidden">
          <img :src="deliveryTruck" alt="Delivery" class="w-full h-auto" />
        </div>
      </div>
    </section>

    <FaqSection />
    <FooterSection />
  </div>
</template>
