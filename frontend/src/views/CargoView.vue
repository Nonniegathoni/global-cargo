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

const cargo = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'description', label: 'Description', required: true },
  { key: 'weight', label: 'Weight' },
  { key: 'volume', label: 'Volume' },
  { key: 'client_id', label: 'Client ID' },
  { key: 'cargo_type', label: 'Type' },
  { key: 'is_active', label: 'Active' }
]

async function fetchCargo() {
  cargo.value = (await getCargo()).data
}
onMounted(fetchCargo)

async function handleAdd(data) {
  await createCargo(data)
  await fetchCargo()
}
async function handleEdit(data) {
  await updateCargo(data.id, data)
  await fetchCargo()
}
async function handleDelete(id) {
  await deleteCargo(id)
  await fetchCargo()
}
</script>