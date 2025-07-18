<template>
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>Name</th>
          <th>Registration #</th>
          <th>Capacity</th>
          <th>Type</th>
          <th>Status</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ship in ships" :key="ship.id">
          <td>{{ ship.name }}</td>
          <td>{{ ship.registration_number }}</td>
          <td>{{ ship.capacity_in_tonnes }}</td>
          <td>{{ ship.type }}</td>
          <td>{{ ship.status }}</td>
          <td>{{ ship.is_active ? 'Yes' : 'No' }}</td>
          <td>
            <button @click="$emit('edit', ship)">Edit</button>
            <button @click="$emit('delete', ship)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script setup lang="ts">
  defineProps<{ ships: any[] }>();
  defineEmits(['edit', 'delete']);
  </script>