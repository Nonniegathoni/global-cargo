<template>
  <CrudTable
    title="Ports"
    :fields="fields"
    :items="ports"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchPorts"
  />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getPorts, createPort, updatePort, deletePort } from '../api/ports'

const ports = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Name', required: true },
  { key: 'country', label: 'Country' },
  { key: 'port_type', label: 'Type' },
  { key: 'coordinates', label: 'Coordinates' },
  { key: 'docking_capacity', label: 'Docking Capacity' },
  { key: 'is_active', label: 'Active' }
]

async function fetchPorts() {
  ports.value = (await getPorts()).data
}
onMounted(fetchPorts)

async function handleAdd(data) {
  await createPort(data)
  await fetchPorts()
}
async function handleEdit(data) {
  await updatePort(data.id, data)
  await fetchPorts()
}
async function handleDelete(id) {
  await deletePort(id)
  await fetchPorts()
}
</script>