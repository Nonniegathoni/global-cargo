<template>
    <form @submit.prevent="onSubmit">
      <div>
        <label>Name:</label>
        <input v-model="form.name" required maxlength="255" />
      </div>
      <div>
        <label>Country:</label>
        <input v-model="form.country" required maxlength="100" />
      </div>
      <div>
        <label>Type:</label>
        <input v-model="form.port_type" maxlength="100" />
      </div>
      <div>
        <label>Coordinates:</label>
        <input v-model="form.coordinates" maxlength="50" />
      </div>
      <div>
        <label>Docking Capacity:</label>
        <input v-model.number="form.docking_capacity" type="number" min="0" />
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