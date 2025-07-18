<template>
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>Name</th>
          <th>Country</th>
          <th>Type</th>
          <th>Coordinates</th>
          <th>Docking Capacity</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="port in ports" :key="port.id">
          <td>{{ port.name }}</td>
          <td>{{ port.country }}</td>
          <td>{{ port.port_type }}</td>
          <td>{{ port.coordinates }}</td>
          <td>{{ port.docking_capacity }}</td>
          <td>{{ port.is_active ? 'Yes' : 'No' }}</td>
          <td>
            <button @click="$emit('edit', port)">Edit</button>
            <button @click="$emit('delete', port)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  <script setup lang="ts">
  defineProps<{ ports: any[] }>();
  defineEmits(['edit', 'delete']);
  </script>


