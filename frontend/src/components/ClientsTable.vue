<template>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="client in clients" :key="client.id">
        <td>{{ client.first_name }}</td>
        <td>{{ client.last_name }}</td>
        <td>{{ client.email_address }}</td>
        <td>{{ client.phone_number }}</td>
        <td>{{ client.is_active ? 'Yes' : 'No' }}</td>
        <td>
          <button @click="$emit('edit', client)">Edit</button>
          <button @click="$emit('delete', client)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script setup lang="ts">
defineProps<{ clients: any[] }>();
defineEmits(['edit', 'delete']);
</script>
