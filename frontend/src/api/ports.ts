import axios from 'axios';
const API_URL = 'http://localhost:8000/api/ports';

export const getPorts = () => axios.get(API_URL);
export const getPort = (id: number) => axios.get(`${API_URL}/${id}`);
export const createPort = (data: any) => axios.post(API_URL, data);
export const updatePort = (id: number, data: any) => axios.put(`${API_URL}/${id}`, data);
export const deletePort = (id: number) => axios.delete(`${API_URL}/${id}`);
