
import { axiosInstance } from "./http.interceptor";

export const post = async (url, data, configs) => {
  try {
    const response = await axiosInstance.post(url, data, configs);
    const result = response.data;

    return result;
  } catch (error) {
    return error;
  }
}

export const get = async (url, data, configs) => {
  try {
    const response = await axiosInstance.get(url, data, configs);
    const result = response.data;
    return result;
  } catch (error) {
    return error;
  }
}

export const put = async (url, data, configs) => {
  try {
    const response = await axiosInstance.put(url, data, configs);
    const result = response.data;
    return result;
  } catch (error) {
    console.log(error);
    return error;
  }
}

export const del = async (url, data, configs) => {
  try {
    const response = await axiosInstance.delete(url, data, configs);
    const result = response.data;
    return result;
  } catch (error) {
    console.log(error);
    return error;
  }
}

export const request = async (method, url, data, configs) => {
  try {
    const response = await axiosInstance.request(
      {
        url: url,
        method: method,
        data: data,
        ...configs
      }
    );
    const result = response;
    return result;
  } catch (error) {
    return error;
  }
}