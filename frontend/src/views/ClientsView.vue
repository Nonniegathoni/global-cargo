<template>
  <CrudTable
    title="Clients"
    :fields="fields"
    :items="clients"
    :onAdd="handleAdd"
    :onEdit="handleEdit"
    :onDelete="handleDelete"
    @refresh="fetchClients"
  />
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CrudTable from '../components/CrudTable.vue'
import { getClients, createClient, updateClient, deleteClient } from '../api/clients'
import { normalizeBoolean } from '../utils/normalize'

// Define the Client type
interface Client {
  id?: number;
  first_name: string;
  last_name: string;
  email_address?: string;
  phone_number?: string;
  address?: string;
  description?: string;
  is_active: boolean | string | number;
}

const clients = ref<Client[]>([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'first_name', label: 'First Name', required: true },
  { key: 'last_name', label: 'Last Name', required: true },
  { key: 'email_address', label: 'Email' },
  { key: 'phone_number', label: 'Phone' },
  { key: 'address', label: 'Address' },
  { key: 'description', label: 'Description', required: false }
]

async function fetchClients() {
  clients.value = (await getClients()).data
}
onMounted(fetchClients)

async function handleAdd(data: Client) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
  }
  await createClient(normalized)
  await fetchClients()
}
async function handleEdit(data: Client) {
  const normalized = {
    ...data,
    is_active: normalizeBoolean(data.is_active),
  }
  await updateClient(data.id!, normalized)
  await fetchClients()
}
async function handleDelete(id: number) {
  await deleteClient(id)
  await fetchClients()
}
</script>