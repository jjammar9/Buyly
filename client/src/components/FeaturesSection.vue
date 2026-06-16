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
  <section class="features-section">
    <h2 class="features-title">Grocery delivery you can count on</h2>
    <div class="features-grid">
      <div v-for="(feature, i) in features" :key="i" class="feature-card">
        <div class="feature-image">
          <img :src="imageUrls[i]" :alt="feature.title" class="feature-img" />
        </div>
        <h3 class="feature-heading">{{ feature.title }}</h3>
        <p class="feature-text">{{ feature.text }}</p>
      </div>
    </div>
  </section>
</template>

<style scoped>
.features-section {
  width: 71%;
  max-width: 1200px;
  margin: 60px auto 0;
  font-family: DM Sans, sans-serif;
}

.features-title {
  font-size: 28px;
  font-weight: 700;
  color: #222;
  text-align: center;
  margin: 0 0 40px;
}

.features-grid {
  display: flex;
  gap: 24px;
  justify-content: center;
}

.feature-card {
  flex: 1;
  max-width: 350px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.feature-image {
  width: 100%;
  height: 200px;
  border-radius: 12px;
  overflow: hidden;
  background: #f0f0f0;
  margin-bottom: 20px;
}

.feature-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.feature-heading {
  font-size: 20px;
  font-weight: 700;
  color: #222;
  margin: 0 0 8px;
}

.feature-text {
  font-size: 15px;
  font-weight: 400;
  color: #555;
  margin: 0;
  line-height: 1.5;
}
</style>
