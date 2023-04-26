import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost/api', // ここは適宜バックエンドの URL に置き換えてください
  withCredentials: true, // クッキーを送信するために必要です
});

export default api;
