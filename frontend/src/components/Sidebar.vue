<template>
  <aside class="sidebar">
    <div class="sidebar-header">
      <div class="company-title">Global Cargo</div>
      <div class="subtitle">Cargo Management System</div>
    </div>
    <nav class="sidebar-nav">
      <router-link to="/ships" class="nav-link" active-class="active">
        <span class="icon">🚢</span> Ships
      </router-link>
      <router-link to="/crew" class="nav-link" active-class="active">
        <span class="icon">👨‍✈️</span> Crew
      </router-link>
      <router-link to="/clients" class="nav-link" active-class="active">
        <span class="icon">👤</span> Clients
      </router-link>
      <router-link to="/ports" class="nav-link" active-class="active">
        <span class="icon">⚓</span> Ports
      </router-link>
      <router-link to="/cargo" class="nav-link" active-class="active">
        <span class="icon">📦</span> Cargo
      </router-link>
      <router-link to="/shipments" class="nav-link" active-class="active">
        <span class="icon">✈️</span> Shipments
      </router-link>
    </nav>
  </aside>
</template>

<script setup lang="ts">
// No script needed for static sidebar
</script>

<style scoped>
.sidebar {
  width: 220px;
  background: var(--card-bg);
  color: var(--main-text);
  border-right: 1px solid var(--border);
  min-height: 100vh;
  box-shadow: 2px 0 8px rgba(0,0,0,0.03);
}
.sidebar-header {
  padding: 2rem 1.5rem 1rem 1.5rem;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.company-title {
  font-size: 1.6rem;
  font-weight: bold;
  letter-spacing: 1px;
}
.subtitle {
  font-size: 0.95rem;
  color: #c7d0e6;
  margin-top: 0.2rem;
}
.sidebar-nav {
  display: flex;
  flex-direction: column;
  margin-top: 2rem;
}
.nav-link {
  display: flex;
  align-items: center;
  padding: 0.85rem 1.5rem;
  color: var(--main-text);
  text-decoration: none;
  font-size: 1.08rem;
  border-left: 4px solid transparent;
  transition: background 0.15s, border-color 0.15s, color 0.15s;
}
.nav-link .icon {
  margin-right: 0.8rem;
  font-size: 1.2rem;
}
.nav-link.active, .nav-link.router-link-exact-active {
  background: #4e5ba6;
  color: #fff;
  border-left: 4px solid #a18fff;
}
.nav-link:hover {
  background: #4e5ba6;
  color: #fff;
}
</style> 