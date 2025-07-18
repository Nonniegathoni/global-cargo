<template>
    <form @submit.prevent="onSubmit">
      <div>
        <label>First Name:</label>
        <input v-model="form.first_name" required maxlength="150" />
      </div>
      <div>
        <label>Last Name:</label>
        <input v-model="form.last_name" required maxlength="150" />
      </div>
      <div>
        <label>Role:</label>
        <select v-model="form.role" required>
          <option>Captain</option>
          <option>Chief Officer</option>
          <option>Able Seaman</option>
          <option>Ordinary Seaman</option>
          <option>Engine Cadet</option>
          <option>Radio Officer</option>
          <option>Chief Cook</option>
          <option>Steward</option>
          <option>Deckhand</option>
        </select>
      </div>
      <div>
        <label>Phone:</label>
        <input v-model="form.phone_number" required maxlength="30" />
      </div>
      <div>
        <label>Ship ID:</label>
        <input v-model="form.ship_id" type="number" />
      </div>
      <div>
        <label>Nationality:</label>
        <input v-model="form.nationality" maxlength="100" />
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
  function onSubmit() { emit('submit', { ...form }); }
  </script>