<template>
  <CrudTable
    title="Shipments"
    :fields="fields"
    :items="shipments"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchShipments"
  />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getShipments, createShipment, updateShipment, deleteShipment } from '../api/shipments'

const shipments = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'cargo_id', label: 'Cargo ID', required: true },
  { key: 'ship_id', label: 'Ship ID', required: true },
  { key: 'origin_port_id', label: 'Origin Port' },
  { key: 'destination_port_id', label: 'Destination Port' },
  { key: 'departure_date', label: 'Departure', type: 'date' },
  { key: 'arrival_estimate', label: 'Est. Arrival', type: 'date' },
  { key: 'actual_arrival_date', label: 'Actual Arrival', type: 'date' },
  { key: 'status', label: 'Status', type: 'radio', options: ['pending', 'in_transit', 'delivered', 'delayed'] },
  { key: 'description', label: 'Description', required: false },
  { key: 'is_active', label: 'Active', type: 'radio', options: ['true', 'false'] }
]

async function fetchShipments() {
  shipments.value = (await getShipments()).data
}
onMounted(fetchShipments)

async function handleAdd(data) {
  await createShipment(data)
  await fetchShipments()
}
async function handleEdit(data) {
  await updateShipment(data.id, data)
  await fetchShipments()
}
async function handleDelete(id) {
  await deleteShipment(id)
  await fetchShipments()
}
</script>