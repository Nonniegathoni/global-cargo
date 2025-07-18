<template>
  <div class="crud-container">
    <h1>{{ title }}</h1>
    <form @submit.prevent="onSubmit" class="crud-form">
      <template v-for="field in fields" :key="field.key">
        <input
          v-model="form[field.key]"
          :placeholder="field.label"
          :type="field.type || 'text'"
          class="crud-input"
          :required="field.required"
        />
      </template>
      <button type="submit" class="crud-add">
        {{ form.id ? 'Update' : 'Add' }}
      </button>
      <button v-if="form.id" type="button" class="crud-cancel" @click="resetForm">Cancel</button>
    </form>
    <table class="crud-table">
      <thead>
        <tr>
          <th v-for="field in fields" :key="field.key">{{ field.label }}</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td v-for="field in fields" :key="field.key">{{ item[field.key] }}</td>
          <td>
            <button class="crud-edit" @click="editItem(item)">Edit</button>
            <button class="crud-delete" @click="deleteItem(item.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'

const props = defineProps<{
  title: string,
  fields: Array<{ key: string, label: string, required?: boolean, type?: string }>,
  items: any[],
  onAdd: (data: any) => Promise<void>,
  onEdit: (data: any) => Promise<void>,
  onDelete: (id: number) => Promise<void>
}>()

const emit = defineEmits(['refresh'])

const form = ref<any>({})
watch(() => props.fields, () => resetForm(), { immediate: true })

function onSubmit() {
  if (form.value.id) {
    props.onEdit({ ...form.value }).then(() => {
      resetForm()
      emit('refresh')
    })
  } else {
    props.onAdd({ ...form.value }).then(() => {
      resetForm()
      emit('refresh')
    })
  }
}
function editItem(item: any) {
  form.value = { ...item }
}
function deleteItem(id: number) {
  props.onDelete(id).then(() => emit('refresh'))
  if (form.value.id === id) resetForm()
}
function resetForm() {
  form.value = {}
}
</script>

<style scoped>
.crud-container {
  max-width: 700px;
  margin: 2rem auto;
  background: #f6f0fa;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 2px 8px #d1c4e9;
}
h1 {
  text-align: center;
  color: #3f51b5;
  margin-bottom: 1.5rem;
}
.crud-form {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
  justify-content: center;
}
.crud-input {
  flex: 1;
  padding: 0.5rem;
  border: 1px solid #b39ddb;
  border-radius: 8px;
  font-size: 1rem;
}
.crud-add {
  background: #3f51b5;
  color: #fff;
  border: none;
  padding: 0 1.5rem;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.2s;
}
.crud-add:hover {
  background: #5c6bc0;
}
.crud-cancel {
  background: #b39ddb;
  color: #fff;
  border: none;
  padding: 0 1rem;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
}
.crud-table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 1px 4px #d1c4e9;
}
.crud-table th, .crud-table td {
  padding: 0.75rem 1rem;
  text-align: left;
}
.crud-table th {
  background: #ede7f6;
  color: #3f51b5;
  font-weight: 600;
}
.crud-edit {
  background: #ede7f6;
  color: #3f51b5;
  border: 1px solid #b39ddb;
  border-radius: 6px;
  padding: 0.3rem 1rem;
  margin-right: 0.5rem;
  cursor: pointer;
  transition: background 0.2s;
}
.crud-edit:hover {
  background: #d1c4e9;
}
.crud-delete {
  background: #e57373;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 0.3rem 1rem;
  cursor: pointer;
  transition: background 0.2s;
}
.crud-delete:hover {
  background: #c62828;
}
</style> 