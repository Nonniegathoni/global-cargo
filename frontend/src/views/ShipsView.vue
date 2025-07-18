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
import { normalizeBoolean } from '../utils/normalize'

// Define the Ship type
interface Ship {
  id?: number;
  name: string;
  registration_number: string;
  capacity_in_tonnes?: number;
  type: string;
  status: string;
  description?: string;
  is_active: boolean | string | number;
}

const ships = ref<Ship[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Name', required: true },
  { key: 'registration_number', label: 'Registration #', required: true },
  { key: 'capacity_in_tonnes', label: 'Capacity', type: 'number' },
  { key: 'type', label: 'Type', options: ['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'barge ship'] },
  { key: 'status', label: 'Status', options: ['active', 'inactive', 'under maintenance', 'decommissioned'] },
  { key: 'description', label: 'Description', required: true }
]
  
  async function fetchShips() {
  ships.value = (await getShips()).data
}
onMounted(fetchShips)

async function handleAdd(data: Ship) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    capacity_in_tonnes: data.capacity_in_tonnes !== undefined ? Number(data.capacity_in_tonnes) : undefined,
  }
  await createShip(normalized)
  await fetchShips()
}
async function handleEdit(data: Ship) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    capacity_in_tonnes: data.capacity_in_tonnes !== undefined ? Number(data.capacity_in_tonnes) : undefined,
  }
  await updateShip(data.id!, normalized)
  await fetchShips()
}
async function handleDelete(id: number) {
  await deleteShip(id)
  await fetchShips()
}
  </script>