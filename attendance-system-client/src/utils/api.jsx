// export async function login(user) {
//     const res = await fetch('/api/login', {
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json',
//       },
//       body: JSON.stringify(user),
//     });
//     if (res.ok) {
//       const data = await res.json();
//       return data;
//     } else {
//       throw new Error('Failed to log in');
//     }
//   }
import axios from 'axios';

const baseUrl = 'http://localhost:3000';

export const getAttendances = async () => {
  const response = await axios.get(`${baseUrl}/attendances`);
  return response.data;
};

export const clockIn = async (attendance) => {
  const response = await axios.post(`${baseUrl}/attendances`, attendance);
  return response.data;
};

export const clockOut = async (attendance) => {
  const response = await axios.put(`${baseUrl}/attendances/${attendance.id}`, attendance);
  return response.data;
};

export const login = async (credentials) => {
  const response = await axios.post(`${baseUrl}/login`, credentials);
  return response.data;
};
