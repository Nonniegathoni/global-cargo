<template>
  <div class="crud-flex">
    <div class="crud-table-col">
      <h2>{{ title }}</h2>
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
    <div class="crud-form-col">
      <h3>Insert {{ title.slice(0, -1) }}</h3>
      <form @submit.prevent="onSubmit" class="crud-form">
        <div v-for="field in fields.filter(f => f.key !== 'id')" :key="field.key" class="form-group">
          <label :for="field.key">{{ field.label }}</label>
          <template v-if="field.type === 'radio' && field.options">
            <div class="radio-group">
              <label v-for="opt in field.options" :key="opt">
                <input type="radio" :name="field.key" :value="opt" v-model="form[field.key]" />
                {{ opt }}
              </label>
            </div>
          </template>
          <template v-else-if="field.type === 'date'">
            <input :id="field.key" v-model="form[field.key]" type="date" class="crud-input" :required="field.required" />
          </template>
          <template v-else>
            <input :id="field.key" v-model="form[field.key]" :type="field.type || 'text'" class="crud-input" :required="field.required" :placeholder="field.label" />
          </template>
        </div>
        <button type="submit" class="crud-add">
          {{ form.id ? 'Update' : 'Insert ' + title.slice(0, -1) }}
        </button>
        <button v-if="form.id" type="button" class="crud-cancel" @click="resetForm">Cancel</button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'

const props = defineProps<{
  title: string,
  fields: Array<{ key: string, label: string, required?: boolean, type?: string, options?: string[] }>,
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
.crud-flex {
  display: flex;
  gap: 2rem;
  align-items: flex-start;
  justify-content: center;
  flex-wrap: wrap;
}
.crud-table-col {
  flex: 2;
  min-width: 350px;
}
.crud-form-col {
  flex: 1;
  min-width: 300px;
  background: #f6f0fa;
  border-radius: 12px;
  padding: 1.5rem 1rem;
  box-shadow: 0 2px 8px #d1c4e9;
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
  background: #9575cd;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 0.3rem 1rem;
  margin-right: 0.5rem;
  cursor: pointer;
  transition: background 0.2s;
}
.crud-edit:hover {
  background: #7e57c2;
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
.crud-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}
.crud-input {
  padding: 0.5rem;
  border: 1px solid #b39ddb;
  border-radius: 8px;
  font-size: 1rem;
}
.crud-add {
  background: #3f51b5;
  color: #fff;
  border: none;
  padding: 0.5rem 1.5rem;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.2s;
  margin-top: 0.5rem;
}
.crud-add:hover {
  background: #5c6bc0;
}
.crud-cancel {
  background: #b39ddb;
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 0.5rem;
}
.radio-group {
  display: flex;
  gap: 1rem;
  align-items: center;
}
@media (max-width: 900px) {
  .crud-flex {
    flex-direction: column;
    gap: 1rem;
  }
  .crud-form-col, .crud-table-col {
    min-width: 0;
    width: 100%;
  }
}
</style> 