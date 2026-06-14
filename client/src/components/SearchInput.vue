<template>
  <form role="search" class="search-form">
    <button type="submit" aria-label="Search" class="search-btn">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="#343538" aria-hidden="true">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.496 17.618a8 8 0 1 1 2.121-2.121l3.944 3.942-2.122 2.122zM17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0"/>
      </svg>
    </button>
    <input
      id="search-bar-input"
      autocomplete="off"
      autocorrect="off"
      autocapitalize="none"
      aria-label="Search"
      placeholder="Search products and stores"
      class="search-input"
    />
  </form>
</template>

<style scoped>
.search-form {
  position: relative;
  display: flex;
  align-items: center;
  width: 100%;
  height: 48px;
  background: #f6f6f6;
  border: solid 0.5px #999;
  border-radius: 28px;
  box-shadow: 0 2px 4px 0 #0000000D inset;
}

.search-form:focus-within {
  background: #fff;
}

.search-btn {
  position: absolute;
  left: 4px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border: none;
  background: transparent;
  cursor: pointer;
  border-radius: 50%;
}

.search-btn:hover {
  background: rgba(0, 0, 0, 0.04);
}

.search-btn svg {
  width: 20px;
  height: 20px;
}

.search-input {
  flex: 1;
  height: 100%;
  padding-top: 0;
  padding-bottom: 0;
  padding-left: 0;
  padding-right: 48px;
  border: none;
  background: transparent;
  font-size: 15px;
  font-family: var(--font-sans);
  outline: none;
  color: #000;
  text-indent: 40px;
  box-sizing: border-box;
}

.search-input::placeholder {
  color: #9b9b9b;
}

@media (max-width: 768px) {
  .search-form {
    height: 40px;
  }

  .search-btn {
    width: 36px;
    height: 36px;
  }

  .search-btn svg {
    width: 18px;
    height: 18px;
  }

  .search-input {
    font-size: 14px;
    text-indent: 36px;
    padding-right: 36px;
  }
}
</style>
