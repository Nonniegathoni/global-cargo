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
import { normalizeBoolean } from '../utils/normalize'

// Define the Crew type
interface Crew {
  id?: number;
  first_name: string;
  last_name: string;
  role: string;
  phone_number?: string;
  ship_id?: number;
  nationality?: string;
  description?: string;
  is_active: boolean | string | number;
}

const crew = ref<Crew[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'first_name', label: 'First Name', required: true },
  { key: 'last_name', label: 'Last Name', required: true },
  { key: 'role', label: 'Role', options: ['Captain', 'Chief Officer', 'Able Seaman', 'Ordinary Seaman', 'Engine Cadet', 'Radio Officer', 'Chief Cook', 'Steward', 'Deckhand'] },
  { key: 'phone_number', label: 'Phone' },
  { key: 'ship_id', label: 'Ship ID' },
  { key: 'nationality', label: 'Nationality' },
  { key: 'description', label: 'Description', required: false },
  { key: 'is_active', label: 'Active', required: true },
]

async function fetchCrew() {
  crew.value = (await getCrew()).data
}
onMounted(fetchCrew)

async function handleAdd(data: Crew) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    ship_id: data.ship_id !== undefined ? Number(data.ship_id) : undefined,
  }
  await createCrew(normalized)
  await fetchCrew()
}
async function handleEdit(data: Crew) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    ship_id: data.ship_id !== undefined ? Number(data.ship_id) : undefined,
  }
  await updateCrew(data.id!, normalized)
  await fetchCrew()
}
async function handleDelete(id: number) {
  await deleteCrew(id)
  await fetchCrew()
}
</script>