<template>
  <div class="crud-table-wrapper">
    <div class="crud-form-card">
      <form @submit.prevent="onSubmit" class="crud-form">
        <div v-for="field in fields.filter(f => f.key !== 'id')" :key="field.key" class="form-group">
          <label :for="field.key">{{ field.label }}</label>
          <template v-if="field.key === 'is_active'">
            <div class="is-active-group">
              <button type="button" :class="['is-active-btn', form.is_active === true ? 'active' : '']" @click="form.is_active = true">Active</button>
              <button type="button" :class="['is-active-btn', form.is_active === false ? 'inactive' : '']" @click="form.is_active = false">Inactive</button>
            </div>
          </template>
          <template v-else-if="field.options && field.type !== 'radio'">
            <select :id="field.key" v-model="form[field.key]" class="crud-input">
              <option v-for="opt in field.options" :key="opt" :value="opt">{{ opt }}</option>
            </select>
          </template>
          <template v-else-if="field.type === 'radio' && field.options && field.key !== 'is_active'">
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
        <div class="form-actions">
          <button type="submit" class="crud-add">
            {{ form.id ? 'Update' : 'Insert ' + singularTitle }}
          </button>
          <button v-if="form.id" type="button" class="crud-cancel" @click="resetForm">Cancel</button>
          <button type="button" class="crud-fake" @click="fakeFill">Fake Fill</button>
        </div>
      </form>
    </div>
    <div class="crud-table-card">
      <table class="crud-table">
        <thead>
          <tr>
            <th v-for="field in fields" :key="field.key">{{ field.label }}</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td v-for="field in fields" :key="field.key">{{ item[field.key] }}</td>
            <td>
              <button class="edit-btn" @click="editItem(item)">Edit</button>
              <button class="delete-btn" @click="deleteItem(item.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'
import { faker } from '@faker-js/faker'

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

const singularTitle = props.title.endsWith('s') ? props.title.slice(0, -1) : props.title;

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
function fakeFill() {
  const fake: any = {}
  for (const field of props.fields) {
    if (field.key === 'id') continue
    if (field.key === 'is_active') {
      fake[field.key] = true
    } else if (field.options && field.type !== 'radio') {
      fake[field.key] = field.options[0]
    } else if (field.type === 'radio' && field.options && field.key !== 'is_active') {
      fake[field.key] = field.options[0]
    } else if (field.type === 'date') {
      fake[field.key] = faker.date.recent().toISOString().slice(0, 10)
    } else if (field.type === 'number') {
      fake[field.key] = faker.number.int({ min: 1, max: 999 })
    } else {
      // Guess by label
      const label = field.label.toLowerCase()
      if (label.includes('name')) fake[field.key] = faker.person.fullName()
      else if (label.includes('email')) fake[field.key] = faker.internet.email()
      else if (label.includes('phone')) fake[field.key] = faker.phone.number()
      else if (label.includes('address')) fake[field.key] = faker.location.streetAddress()
      else if (label.includes('description')) fake[field.key] = faker.lorem.sentence()
      else if (label.includes('registration')) fake[field.key] = faker.string.numeric(6)
      else if (label.includes('capacity')) fake[field.key] = faker.number.int({ min: 10, max: 200 })
      else if (label.includes('nationality')) fake[field.key] = faker.location.country()
      else fake[field.key] = faker.word.words(2)
    }
  }
  form.value = fake
}
</script>

<style scoped>
.crud-table-wrapper {
  background: var(--main-bg);
  color: var(--main-text);
}
.crud-form-card, .crud-table-card {
  background: var(--card-bg);
  color: var(--main-text);
  border: 1px solid var(--border);
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.crud-input, select {
  background: var(--main-bg);
  color: var(--main-text);
  border: 1px solid var(--border);
}
.crud-add, .crud-cancel, .crud-fake, .edit-btn, .delete-btn {
  color: var(--main-text);
  background: var(--card-bg);
  border: 1px solid var(--border);
}
.crud-add:hover, .crud-cancel:hover, .crud-fake:hover, .edit-btn:hover, .delete-btn:hover {
  background: var(--main-bg);
}
.crud-table-wrapper {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}
.crud-form-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(59,89,152,0.07);
  padding: 2rem 2.5rem 1.5rem 2.5rem;
  margin-bottom: 0.5rem;
}
.crud-form {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem 2rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  flex: 1 1 220px;
  min-width: 180px;
  margin-bottom: 1rem;
}
label {
  font-weight: 500;
  margin-bottom: 0.4rem;
  color: #3b5998;
}
.crud-input {
  padding: 0.5rem 0.7rem;
  border: 1px solid #c7d0e6;
  border-radius: 5px;
  font-size: 1rem;
  background: #f7f8fa;
}
.is-active-group {
  display: flex;
  gap: 1.2rem;
  margin-top: 0.2rem;
}
.is-active-btn {
  background: #e3e8f7;
  color: #3b5998;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 1.2rem;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
}
.is-active-btn.active {
  background: #3b5998;
  color: #fff;
}
.is-active-btn.inactive {
  background: #a18fff;
  color: #fff;
}
.radio-group {
  display: flex;
  gap: 1.2rem;
  margin-top: 0.2rem;
}
.form-actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.2rem;
}
.crud-add {
  background: #3b5998;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 1.2rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
}
.crud-add:hover {
  background: #4e5ba6;
}
.crud-cancel {
  background: #e3e8f7;
  color: #3b5998;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 1.2rem;
  font-weight: 500;
  cursor: pointer;
}
.crud-fake {
  background: #a18fff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 1.2rem;
  font-weight: 500;
  cursor: pointer;
}
.crud-table-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(59,89,152,0.07);
  padding: 2rem 2.5rem 1.5rem 2.5rem;
}
.crud-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 0.5rem;
}
.crud-table th, .crud-table td {
  padding: 0.7rem 1rem;
  border-bottom: 1px solid #e3e8f7;
  text-align: left;
}
.crud-table th {
  background: #f7f8fa;
  color: #3b5998;
  font-weight: 600;
}
.edit-btn {
  background: #a18fff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 0.3rem 0.9rem;
  margin-right: 0.5rem;
  font-size: 0.98rem;
  cursor: pointer;
  transition: background 0.15s;
}
.edit-btn:hover {
  background: #8c6cff;
}
.delete-btn {
  background: #3b5998;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 0.3rem 0.9rem;
  font-size: 0.98rem;
  cursor: pointer;
  transition: background 0.15s;
}
.delete-btn:hover {
  background: #22306b;
}
</style> 