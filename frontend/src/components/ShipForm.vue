<template>
    <form @submit.prevent="onSubmit">
      <div>
        <label>Name:</label>
        <input v-model="form.name" required maxlength="255" />
      </div>
      <div>
        <label>Registration Number:</label>
        <input v-model="form.registration_number" required maxlength="200" />
      </div>
      <div>
        <label>Capacity (tonnes):</label>
        <input v-model.number="form.capacity_in_tonnes" type="number" min="0" />
      </div>
      <div>
        <label>Type:</label>
        <select v-model="form.type" required>
          <option value="cargo ship">Cargo Ship</option>
          <option value="passenger ship">Passenger Ship</option>
          <option value="military ship">Military Ship</option>
          <option value="icebreaker">Icebreaker</option>
          <option value="fishing vessel">Fishing Vessel</option>
          <option value="barge ship">Barge Ship</option>
        </select>
      </div>
      <div>
        <label>Status:</label>
        <select v-model="form.status" required>
          <option value="active">Active</option>
          <option value="under maintenance">Under Maintenance</option>
          <option value="decommissioned">Decommissioned</option>
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
  
  const props = defineProps<{
    modelValue: any,
  }>();
  const emit = defineEmits(['submit', 'cancel']);
  
  const form = reactive({ ...props.modelValue });
  
  watch(() => props.modelValue, (val) => {
    Object.assign(form, val);
  });
  
  function onSubmit() {
    emit('submit', { ...form });
  }
  </script>