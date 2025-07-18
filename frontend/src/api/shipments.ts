import axios from 'axios';
const API_URL = 'http://localhost:8000/api/shipments';

export const getShipments = () => axios.get(API_URL);
export const getShipment = (id: number) => axios.get(`${API_URL}/${id}`);
export const createShipment = (data: any) => axios.post(API_URL, data);
export const updateShipment = (id: number, data: any) => axios.put(`${API_URL}/${id}`, data);
export const deleteShipment = (id: number) => axios.delete(`${API_URL}/${id}`);