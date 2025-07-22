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
import { normalizeBoolean } from '../utils/normalize'

// Define the Shipment type
interface Shipment {
  id?: number;
  cargo_id: number | string;
  ship_id: number | string;
  origin_port_id?: number | string;
  destination_port_id?: number | string;
  departure_date?: string;
  arrival_estimate?: string;
  actual_arrival_date?: string;
  status: string;
  description?: string;
  is_active: boolean | string | number;
}

const shipments = ref<Shipment[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'cargo_id', label: 'Cargo ID', required: true },
  { key: 'ship_id', label: 'Ship ID', required: true },
  { key: 'origin_port_id', label: 'Origin Port' },
  { key: 'destination_port_id', label: 'Destination Port' },
  { key: 'departure_date', label: 'Departure', type: 'date' },
  { key: 'arrival_estimate', label: 'Est. Arrival', type: 'date' },
  { key: 'actual_arrival_date', label: 'Actual Arrival', type: 'date' },
  { key: 'status', label: 'Status', options: ['pending', 'in_transit', 'delivered', 'delayed'] },
  { key: 'description', label: 'Description', required: false },
  { key: 'is_active', label: 'Active', required: true },
]

async function fetchShipments() {
  shipments.value = (await getShipments()).data
}
onMounted(fetchShipments)

async function handleAdd(data: Shipment) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    cargo_id: data.cargo_id !== undefined ? Number(data.cargo_id) : undefined,
    ship_id: data.ship_id !== undefined ? Number(data.ship_id) : undefined,
    origin_port_id: data.origin_port_id !== undefined ? Number(data.origin_port_id) : undefined,
    destination_port_id: data.destination_port_id !== undefined ? Number(data.destination_port_id) : undefined,
  }
  await createShipment(normalized)
  await fetchShipments()
}
async function handleEdit(data: Shipment) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
    cargo_id: data.cargo_id !== undefined ? Number(data.cargo_id) : undefined,
    ship_id: data.ship_id !== undefined ? Number(data.ship_id) : undefined,
    origin_port_id: data.origin_port_id !== undefined ? Number(data.origin_port_id) : undefined,
    destination_port_id: data.destination_port_id !== undefined ? Number(data.destination_port_id) : undefined,
  }
  await updateShipment(data.id!, normalized)
  await fetchShipments()
}
async function handleDelete(id: number) {
  await deleteShipment(id)
  await fetchShipments()
}
</script>