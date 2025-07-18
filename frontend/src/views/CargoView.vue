<template>
  <CrudTable
    title="Cargo"
    :fields="fields"
    :items="cargo"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchCargo"
  />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getCargo, createCargo, updateCargo, deleteCargo } from '../api/cargo'
import { normalizeBoolean } from '../utils/normalize'

// Define the Cargo type
interface Cargo {
  id?: number;
  description: string;
  weight?: number;
  volume?: number;
  client_id?: number;
  cargo_type: string;
  is_active: boolean | string | number;
}

const cargo = ref<Cargo[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'description', label: 'Description', required: true },
  { key: 'weight', label: 'Weight' },
  { key: 'volume', label: 'Volume' },
  { key: 'client_id', label: 'Client ID' },
  { key: 'type', label: 'Type', options: ['perishable', 'dangerous', 'general', 'other'] }
]

async function fetchCargo() {
  cargo.value = (await getCargo()).data
}
onMounted(fetchCargo)

async function handleAdd(data: Cargo) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    weight: data.weight !== undefined ? Number(data.weight) : undefined,
    volume: data.volume !== undefined ? Number(data.volume) : undefined,
    client_id: data.client_id !== undefined ? Number(data.client_id) : undefined,
  }
  await createCargo(normalized)
  await fetchCargo()
}
async function handleEdit(data: Cargo) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    weight: data.weight !== undefined ? Number(data.weight) : undefined,
    volume: data.volume !== undefined ? Number(data.volume) : undefined,
    client_id: data.client_id !== undefined ? Number(data.client_id) : undefined,
  }
  await updateCargo(data.id!, normalized)
  await fetchCargo()
}
async function handleDelete(id: number) {
  await deleteCargo(id)
  await fetchCargo()
}
</script>