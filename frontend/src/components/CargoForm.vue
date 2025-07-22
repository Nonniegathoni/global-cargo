<template>
    <form @submit.prevent="onSubmit">
      <div>
        <label>Description:</label>
        <input v-model="form.description" required />
      </div>
      <div>
        <label>Weight:</label>
        <input v-model.number="form.weight" type="number" min="0.01" step="0.01" required />
      </div>
      <div>
        <label>Volume:</label>
        <input v-model.number="form.volume" type="number" min="0" step="0.01" />
      </div>
      <div>
        <label>Client ID:</label>
        <input v-model="form.client_id" type="number" required />
      </div>
      <div>
        <label>Type:</label>
        <select v-model="form.cargo_type" required>
          <option value="perishable">Perishable</option>
          <option value="dangerous">Dangerous</option>
          <option value="general">General</option>
          <option value="other">Other</option>
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


