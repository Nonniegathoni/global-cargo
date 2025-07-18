import axios from 'axios';
const API_URL = 'http://localhost:8000/api/cargo';

export const getCargo = () => axios.get(API_URL);
export const getCargoItem = (id: number) => axios.get(`${API_URL}/${id}`);
export const createCargo = (data: any) => axios.post(API_URL, data);
export const updateCargo = (id: number, data: any) => axios.put(`${API_URL}/${id}`, data);
export const deleteCargo = (id: number) => axios.delete(`${API_URL}/${id}`);
