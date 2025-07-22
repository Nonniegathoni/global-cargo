<template>
    <form @submit.prevent="onSubmit">
      <div>
        <label>Cargo ID:</label>
        <input v-model="form.cargo_id" type="number" required />
      </div>
      <div>
        <label>Ship ID:</label>
        <input v-model="form.ship_id" type="number" required />
      </div>
      <div>
        <label>Origin Port ID:</label>
        <input v-model="form.origin_port_id" type="number" required />
      </div>
      <div>
        <label>Destination Port ID:</label>
        <input v-model="form.destination_port_id" type="number" required />
      </div>
      <div>
        <label>Departure Date:</label>
        <input v-model="form.departure_date" type="date" required />
      </div>
      <div>
        <label>Estimated Arrival:</label>
        <input v-model="form.arrival_estimate" type="date" required />
      </div>
      <div>
        <label>Actual Arrival:</label>
        <input v-model="form.actual_arrival_date" type="date" />
      </div>
      <div>
        <label>Status:</label>
        <select v-model="form.status" required>
          <option value="pending">Pending</option>
          <option value="in_transit">In Transit</option>
          <option value="delivered">Delivered</option>
          <option value="delayed">Delayed</option>
        </select>
      </div>
      <div>
        <label>Active:</label>
        <input type="checkbox" v-model="form.is_active" />
      </div>
      <button type="submit">{{ form.id ? 'Update' : 'Create' }}</button>
      <button type="button" @click="$emit('cancel')">Cancel</button>
    </form>
  </template>
  <script setup lang="ts">
  import { reactive, watch } from 'vue';
  const props = defineProps<{ modelValue: any }>();
  const emit = defineEmits(['submit', 'cancel']);
  const form = reactive({ ...props.modelValue });
  watch(() => props.modelValue, (val) => Object.assign(form, val));
  function onSubmit() { emit('submit', { ...form, is_active: true }); }
  </script>


