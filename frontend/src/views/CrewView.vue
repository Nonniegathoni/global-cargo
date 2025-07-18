<template>
  <CrudTable
    title="Crew"
    :fields="fields"
    :items="crew"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchCrew"
  />
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getCrew, createCrew, updateCrew, deleteCrew } from '../api/crew'

const crew = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'first_name', label: 'First Name', required: true },
  { key: 'last_name', label: 'Last Name', required: true },
  { key: 'role', label: 'Role' },
  { key: 'phone_number', label: 'Phone' },
  { key: 'ship_id', label: 'Ship ID' },
  { key: 'nationality', label: 'Nationality' },
  { key: 'is_active', label: 'Active' }
]

async function fetchCrew() {
  crew.value = (await getCrew()).data
}
onMounted(fetchCrew)

async function handleAdd(data) {
  await createCrew(data)
  await fetchCrew()
}
async function handleEdit(data) {
  await updateCrew(data.id, data)
  await fetchCrew()
}
async function handleDelete(id) {
  await deleteCrew(id)
  await fetchCrew()
}
</script>