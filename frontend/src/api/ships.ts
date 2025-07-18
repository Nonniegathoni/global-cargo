import axios from 'axios';

const API_URL = 'http://localhost:8000/api/ships';

export const getShips = () => axios.get(API_URL);
export const getShip = (id: number) => axios.get(`${API_URL}/${id}`);
export const createShip = (data: any) => axios.post(API_URL, data);
export const updateShip = (id: number, data: any) => axios.put(`${API_URL}/${id}`, data);
export const deleteShip = (id: number) => axios.delete(`${API_URL}/${id}`);