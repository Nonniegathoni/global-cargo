import axios from 'axios';
const API_URL = 'http://localhost:8000/api/crew';

export const getCrew = () => axios.get(API_URL);
export const getCrewMember = (id: number) => axios.get(`${API_URL}/${id}`);
export const createCrew = (data: any) => axios.post(API_URL, data);
export const updateCrew = (id: number, data: any) => axios.put(`${API_URL}/${id}`, data);
export const deleteCrew = (id: number) => axios.delete(`${API_URL}/${id}`);
