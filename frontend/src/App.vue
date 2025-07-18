<script setup lang="ts">
import Sidebar from './components/Sidebar.vue'
</script>

<template>
  <div class="app-layout">
    <Sidebar />
    <div class="main-content">
      <header class="top-bar">
        <div class="app-title">Global Cargo Management System</div>
        <div class="user-info">
          <span class="user-icon">👤</span> User
        </div>
      </header>
      <div class="content-area">
        <router-view />
      </div>
    </div>
  </div>
</template>

<style scoped>
.app-layout {
  display: flex;
  min-height: 100vh;
}
.main-content {
  flex: 1;
  background: #f7f8fa;
  display: flex;
  flex-direction: column;
}
.top-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 60px;
  background: #fff;
  border-bottom: 1px solid #e3e8f7;
  padding: 0 2.5rem;
  font-size: 1.2rem;
  font-weight: 500;
  color: #3b5998;
  box-shadow: 0 2px 4px rgba(0,0,0,0.03);
}
.app-title {
  font-weight: bold;
  font-size: 1.25rem;
  letter-spacing: 0.5px;
}
.user-info {
  display: flex;
  align-items: center;
  color: #3b5998;
  font-size: 1rem;
}
.user-icon {
  margin-right: 0.5rem;
  font-size: 1.3rem;
}
.content-area {
  flex: 1;
  padding: 2rem 2.5rem;
}
</style>