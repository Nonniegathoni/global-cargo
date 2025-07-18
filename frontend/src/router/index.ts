import { createRouter, createWebHistory } from 'vue-router'
import ShipsView from '../views/ShipsView.vue'
import CrewView from '../views/CrewView.vue'
import ClientsView from '../views/ClientsView.vue'
import PortsView from '../views/PortsView.vue'
import CargoView from '../views/CargoView.vue'
import ShipmentsView from '../views/ShipmentsView.vue'


const routes = [
  { path: '/', redirect: '/ships' },
  { path: '/ships', component: ShipsView },
  { path: '/crew', component: CrewView },
  { path: '/clients', component: ClientsView },
  { path: '/ports', component: PortsView },
  { path: '/cargo', component: CargoView },
  { path: '/shipments', component: ShipmentsView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router