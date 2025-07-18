<template>
  <CrudTable
    title="Ships"
    :fields="fields"
    :items="ships"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchShips"
  />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getShips, createShip, updateShip, deleteShip } from '../api/ships'

const ships = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Name', required: true },
  { key: 'registration_number', label: 'Registration #', required: true },
  { key: 'capacity_in_tonnes', label: 'Capacity', type: 'number' },
  { key: 'type', label: 'Type', type: 'radio', options: ['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'barge ship'] },
  { key: 'status', label: 'Status', type: 'radio', options: ['active', 'under maintenance', 'decommissioned'] },
  { key: 'description', label: 'Description', required: true },
  { key: 'is_active', label: 'Active', type: 'radio', options: ['true', 'false'] }
]

async function fetchShips() {
  ships.value = (await getShips()).data
}
onMounted(fetchShips)

async function handleAdd(data) {
  await createShip(data)
  await fetchShips()
}
async function handleEdit(data) {
  await updateShip(data.id, data)
  await fetchShips()
}
async function handleDelete(id) {
  await deleteShip(id)
  await fetchShips()
}
</script>