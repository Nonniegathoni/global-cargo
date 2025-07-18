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
        <label>Email:</label>
        <input v-model="form.email_address" type="email" maxlength="150" />
      </div>
      <div>
        <label>Phone:</label>
        <input v-model="form.phone_number" maxlength="50" />
      </div>
      <div>
        <label>Address:</label>
        <input v-model="form.address" />
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