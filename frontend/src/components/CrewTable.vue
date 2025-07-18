<template>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Phone</th>
        <th>Ship ID</th>
        <th>Nationality</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="member in crew" :key="member.id">
        <td>{{ member.first_name }}</td>
        <td>{{ member.last_name }}</td>
        <td>{{ member.role }}</td>
        <td>{{ member.phone_number }}</td>
        <td>{{ member.ship_id }}</td>
        <td>{{ member.nationality }}</td>
        <td>{{ member.is_active ? 'Yes' : 'No' }}</td>
        <td>
          <button @click="$emit('edit', member)">Edit</button>
          <button @click="$emit('delete', member)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script setup lang="ts">
defineProps<{ crew: any[] }>();
defineEmits(['edit', 'delete']);
</script>
