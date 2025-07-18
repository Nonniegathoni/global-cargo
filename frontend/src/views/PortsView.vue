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
import { normalizeBoolean } from '../utils/normalize'

// Define the Port type
interface Port {
  id?: number;
  name: string;
  country?: string;
  port_type?: string;
  coordinates?: string;
  docking_capacity?: number;
  description?: string;
  is_active: boolean | string | number;
}

const ports = ref<Port[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Name', required: true },
  { key: 'country', label: 'Country' },
  { key: 'port_type', label: 'Type' },
  { key: 'coordinates', label: 'Coordinates' },
  { key: 'docking_capacity', label: 'Docking Capacity' },
  { key: 'description', label: 'Description', required: false }
]

async function fetchPorts() {
  ports.value = (await getPorts()).data
}
onMounted(fetchPorts)

async function handleAdd(data: Port) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    docking_capacity: data.docking_capacity !== undefined ? Number(data.docking_capacity) : undefined,
  }
  await createPort(normalized)
  await fetchPorts()
}
async function handleEdit(data: Port) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    docking_capacity: data.docking_capacity !== undefined ? Number(data.docking_capacity) : undefined,
  }
  await updatePort(data.id!, normalized)
  await fetchPorts()
}
async function handleDelete(id: number) {
  await deletePort(id)
  await fetchPorts()
}
</script>