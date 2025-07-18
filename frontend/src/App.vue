<script setup lang="ts">
</script>

<template>
  <div>
    <nav>
      <router-link to="/ships">Ships</router-link> |
      <router-link to="/crew">Crew</router-link> |
      <router-link to="/clients">Clients</router-link> |
      <router-link to="/ports">Ports</router-link> |
      <router-link to="/cargo">Cargo</router-link> |
      <router-link to="/shipments">Shipments</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script setup lang="ts">
// No script needed for now
</script>

<style>
nav {
  margin-bottom: 2rem;
}
nav a {
  margin: 0 0.5rem;
  text-decoration: none;
  color: #42b983;
  font-weight: bold;
}
nav a.router-link-exact-active {
  color: #35495e;
  text-decoration: underline;
}
</style>