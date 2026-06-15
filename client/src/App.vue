<script setup>
import NavBar from './components/NavBar.vue'
import HeroSection from './components/HeroSection.vue'
</script>

<template>
  <div class="app">
    <NavBar />
    <HeroSection />
  </div>
</template>

<style scoped>
.main-content {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 40px 0;
}

.content-left {
  flex: 1;
}

.content-right {
  flex-shrink: 0;
}
</style>
