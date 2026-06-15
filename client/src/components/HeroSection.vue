<template>
  <section class="hero">
    <div class="hero-inner">
      <div class="hero-left">
        <h1 class="hero-heading">
          Order groceries for delivery or<br />pickup today
        </h1>
        <button class="hero-btn" data-full-width="true">
          <span>Sign up to get $0 delivery fee*</span>
        </button>
        <a href="#" class="hero-terms"
          >*Valid for first 3 orders. Service fees and terms apply.</a
        >
      </div>
      <div
        class="hero-right"
        :style="{ backgroundImage: `url(${heroBg})` }"
      ></div>
    </div>
  </section>
</template>

<script setup>
import heroBg from "../assets/Hero.png";
</script>

<style scoped>
.hero,
.hero-inner {
  height: 30vh;
  background: #003d29;
  display: flex;
  width: 100%;
}

.hero-inner {
  max-width: 1152px;
  margin: 0 auto;
  gap: 16px;
}

.hero-left {
  width: 40%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px 40px;
}
.hero-right {
  width: 60%;
  background-position: left;
  background-repeat: no-repeat;
}

.hero-heading {
  color: #fff;
  font-family: var(--font-sans);
  font-size: 24px;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 8px;
  text-align: center;
}
.hero-btn {
  font-size: 16px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  box-shadow: none;
  background: #108910;
  border: none;
  border-radius: calc(40px / 2);
  color: #FFFFFF;
  height: 40px;
  padding-left: 24px;
  padding-right: 24px;
  position: relative;
  margin-top: 12px;
  margin-bottom: 12px;
}
.hero-terms {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.65);
  font-family: var(--font-sans);
  display: block;
  cursor: pointer;
  text-decoration: underline;
  margin-top: 4px;
  text-align: center;
}
</style>
