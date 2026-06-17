<template>
  <section class="h-[30vh] bg-[#003d29] flex w-full">
    <div class="flex w-full max-w-[1152px] mx-auto gap-4">
      <div class="w-[40%] flex flex-col justify-center items-center px-10 py-5">
        <h1 class="text-white text-[28px] font-bold leading-[1.2] mb-2 text-center">
          <span style="white-space: nowrap">Order groceries for delivery or</span><br />pickup today
        </h1>
        <a href="/catalog"
          class="text-[18px] cursor-pointer select-none shadow-none bg-[#108910] border-0 rounded-[28px] text-white h-14 px-6 py-4 relative mt-3 mb-3 no-underline flex items-center justify-center"
        >
          <span>Sign up to get $0 delivery fee*</span>
        </a>
        <a
          href="#"
          class="text-[13px] text-[rgba(255,255,255,0.65)] block cursor-pointer underline mt-1 text-center"
        >*Valid for first 3 orders. Service fees and terms apply.</a>
      </div>
      <div
        class="w-[60%] bg-left bg-no-repeat"
        :style="{ backgroundImage: `url(${heroBg})` }"
      ></div>
    </div>
  </section>
</template>

<script setup>
import heroBg from "../assets/Hero.png";
</script>
