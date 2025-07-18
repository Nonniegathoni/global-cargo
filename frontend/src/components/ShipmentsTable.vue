<template>
    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>Cargo ID</th>
          <th>Ship ID</th>
          <th>Origin Port</th>
          <th>Destination Port</th>
          <th>Departure</th>
          <th>Est. Arrival</th>
          <th>Actual Arrival</th>
          <th>Status</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="shipment in shipments" :key="shipment.id">
          <td>{{ shipment.cargo_id }}</td>
          <td>{{ shipment.ship_id }}</td>
          <td>{{ shipment.origin_port_id }}</td>
          <td>{{ shipment.destination_port_id }}</td>
          <td>{{ shipment.departure_date }}</td>
          <td>{{ shipment.arrival_estimate }}</td>
          <td>{{ shipment.actual_arrival_date }}</td>
          <td>{{ shipment.status }}</td>
          <td>{{ shipment.is_active ? 'Yes' : 'No' }}</td>
          <td>
            <button @click="$emit('edit', shipment)">Edit</button>
            <button @click="$emit('delete', shipment)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  <script setup lang="ts">
  defineProps<{ shipments: any[] }>();
  defineEmits(['edit', 'delete']);
  </script>