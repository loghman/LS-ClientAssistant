import axios from "axios";
import Cookies from "js-cookie";

class requestHandler {
  constructor(baseURL) {
    this.instance = axios.create({
      baseURL,
      headers: {
        "Content-Type": "application/json",
      },
    });

    this.instance.interceptors.request.use((config) => {
      const token = Cookies.get('token');
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
      return config;
    });

    this.instance.interceptors.response.use(
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
  }

  get(url) {
    return this.instance.get(url);
  }

  post(url, data) {
    return this.instance.post(url, data);
  }
 async request(method,url,data){
   try {
    const response=await this.instance.request({
        method,
        url,
        data
    })
    return response;
   } catch (error) {
    console.error('Request failed:', error);
    throw error;
   }
 }
}

export default requestHandler;
