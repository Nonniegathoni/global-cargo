<script setup lang="ts">
import { ref, onMounted } from 'vue'
import Sidebar from './components/Sidebar.vue'

const isDark = ref(false)

function toggleTheme() {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark', isDark.value)
  localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}

onMounted(() => {
  const saved = localStorage.getItem('theme')
  isDark.value = saved === 'dark'
  document.documentElement.classList.toggle('dark', isDark.value)
})
</script>

<template>
  <div class="app-layout">
    <Sidebar />
    <div class="main-content">
      <header class="top-bar">
        <div class="app-title">Global Cargo Management System</div>
        <div class="user-info">
          <span class="user-icon">👤</span> User
          <button class="theme-toggle" @click="toggleTheme" :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
            <span v-if="isDark">🌙</span>
            <span v-else>☀️</span>
          </button>
        </div>
      </header>
      <div class="content-area">
        <router-view />
      </div>
    </div>
  </div>
</template>

<style scoped>
.theme-toggle {
  background: none;
  border: none;
  font-size: 1.3rem;
  margin-left: 1rem;
  cursor: pointer;
  color: #3b5998;
}
:root {
  --main-bg: #f7f8fa;
  --main-text: #3b5998;
  --card-bg: #fff;
  --border: #e3e8f7;
}
.dark {
  --main-bg: #181a20;
  --main-text: #e3e8f7;
  --card-bg: #232634;
  --border: #2c2f3a;
}
.app-layout {
  background: var(--main-bg);
  color: var(--main-text);
}
.main-content {
  background: var(--main-bg);
  color: var(--main-text);
}
.top-bar {
  background: var(--card-bg);
  border-bottom: 1px solid var(--border);
  color: var(--main-text);
}
.user-info {
  color: var(--main-text);
}
.content-area {
  background: var(--main-bg);
  color: var(--main-text);
}
</style>