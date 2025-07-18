<template>
    <div class="crud-container">
      <h1>Vue.js CRUD Example</h1>
      <form @submit.prevent="onAddOrUpdate" class="crud-form">
        <input
          v-model="form.name"
          placeholder="New item"
          class="crud-input"
          required
        />
        <button type="submit" class="crud-add">
          {{ form.id ? 'Update' : 'Add' }}
        </button>
        <button v-if="form.id" type="button" class="crud-cancel" @click="resetForm">Cancel</button>
      </form>
      <table class="crud-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>
              <button class="crud-edit" @click="editItem(item)">Edit</button>
              <button class="crud-delete" @click="deleteItem(item.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  
  interface Item {
    id: number
    name: string
  }
  
  const items = ref<Item[]>([
    { id: 1, name: 'Item 1' },
    { id: 2, name: 'Item 2' },
    { id: 3, name: 'Item 3' }
  ])
  
  const form = ref<{ id: number | null; name: string }>({ id: null, name: '' })
  
  function onAddOrUpdate() {
    if (form.value.id) {
      // Update
      const idx = items.value.findIndex(i => i.id === form.value.id)
      if (idx !== -1) items.value[idx].name = form.value.name
    } else {
      // Add
      const newId = items.value.length ? Math.max(...items.value.map(i => i.id)) + 1 : 1
      items.value.push({ id: newId, name: form.value.name })
    }
    resetForm()
  }
  
  function editItem(item: Item) {
    form.value = { ...item }
  }
  
  function deleteItem(id: number) {
    items.value = items.value.filter(i => i.id !== id)
    if (form.value.id === id) resetForm()
  }
  
  function resetForm() {
    form.value = { id: null, name: '' }
  }
  </script>
  
  <style scoped>
  .crud-container {
    max-width: 500px;
    margin: 2rem auto;
    background: #f6f0fa;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 2px 8px #d1c4e9;
  }
  h1 {
    text-align: center;
    color: #3f51b5;
    margin-bottom: 1.5rem;
  }
  .crud-form {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    justify-content: center;
  }
  .crud-input {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid #b39ddb;
    border-radius: 8px;
    font-size: 1rem;
  }
  .crud-add {
    background: #3f51b5;
    color: #fff;
    border: none;
    padding: 0 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
  }
  .crud-add:hover {
    background: #5c6bc0;
  }
  .crud-cancel {
    background: #b39ddb;
    color: #fff;
    border: none;
    padding: 0 1rem;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
  }
  .crud-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px #d1c4e9;
  }
  .crud-table th, .crud-table td {
    padding: 0.75rem 1rem;
    text-align: left;
  }
  .crud-table th {
    background: #ede7f6;
    color: #3f51b5;
    font-weight: 600;
  }
  .crud-edit {
    background: #ede7f6;
    color: #3f51b5;
    border: 1px solid #b39ddb;
    border-radius: 6px;
    padding: 0.3rem 1rem;
    margin-right: 0.5rem;
    cursor: pointer;
    transition: background 0.2s;
  }
  .crud-edit:hover {
    background: #d1c4e9;
  }
  .crud-delete {
    background: #e57373;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 0.3rem 1rem;
    cursor: pointer;
    transition: background 0.2s;
  }
  .crud-delete:hover {
    background: #c62828;
  }
  </style>