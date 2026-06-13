<script setup>
import NavBar from './components/NavBar.vue'
</script>

<template>
  <div class="app">
    <NavBar />
    <div class="container">
      <main class="main-content">
        <div class="content-left">
          <h1>Welcome to Buyly</h1>
        </div>
        <div class="content-right">
          <p>Your grocery delivery service</p>
        </div>
      </main>
    </div>
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
