<template>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>Description</th>
        <th>Weight</th>
        <th>Volume</th>
        <th>Client ID</th>
        <th>Type</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in cargo" :key="item.id">
        <td>{{ item.description }}</td>
        <td>{{ item.weight }}</td>
        <td>{{ item.volume }}</td>
        <td>{{ item.client_id }}</td>
        <td>{{ item.cargo_type }}</td>
        <td>{{ item.is_active ? 'Yes' : 'No' }}</td>
        <td>
          <button @click="$emit('edit', item)">Edit</button>
          <button @click="$emit('delete', item)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script setup lang="ts">
defineProps<{ cargo: any[] }>();
defineEmits(['edit', 'delete']);
</script>
