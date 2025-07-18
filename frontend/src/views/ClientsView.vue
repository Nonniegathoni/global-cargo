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

const clients = ref([])
const fields = [
  { key: 'id', label: 'ID' },
  { key: 'first_name', label: 'First Name', required: true },
  { key: 'last_name', label: 'Last Name', required: true },
  { key: 'email_address', label: 'Email' },
  { key: 'phone_number', label: 'Phone' },
  { key: 'address', label: 'Address' },
  { key: 'description', label: 'Description', required: false },
  { key: 'is_active', label: 'Active', type: 'radio', options: ['true', 'false'] }
]

async function fetchClients() {
  clients.value = (await getClients()).data
}
onMounted(fetchClients)

async function handleAdd(data) {
  await createClient(data)
  await fetchClients()
}
async function handleEdit(data) {
  await updateClient(data.id, data)
  await fetchClients()
}
async function handleDelete(id) {
  await deleteClient(id)
  await fetchClients()
}
</script>