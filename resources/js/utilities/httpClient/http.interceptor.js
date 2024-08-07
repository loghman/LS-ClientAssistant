import axios from "axios";
import Cookies from "js-cookie";
import { messages } from "../static-messages";
import { exposedEnvVariables } from "../../../../views/vue-apps/components/auth/useAuth";
const instance = axios.create({
  baseURL:exposedEnvVariables.API_BASE_URL,
  headers: {
    "Content-Type": "application/json",
  },
});

instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
    if (error.response && error.response.status === 403) {
      toast(messages.LOGIN_FIRST,'warning');
      window.location.href = '/auth';
    }
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
