import axios from "axios";
import Cookies from "js-cookie";
const baseURL=import.meta.env.VITE_BASE_URL;
const instance = axios.create({
  baseURL: baseURL,
  headers: {
    "Content-Type": "application/json",
  },
});

instance.interceptors.request.use((config) => {
  const token = Cookies.get('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});

instance.interceptors.response.use(
  (response) => response,
  async (error) => {
    const expectedError = error.response && error.response.data.status == false;
    if (!expectedError) {
      //  unexpected errors 
      return Promise.reject(error);
    }
    // expected errors
    return Promise.reject(error.response.data);
  }
);

export const axiosInstance = instance;
