import axios from 'axios';
import get from 'lodash/get';

const service = axios.create({
  baseURL: '/admin/',
  params: {}
});

service.interceptors.response.use(
  response => {
    return response;
  },
  (error) => {
    const messages = get(error, 'response.data.messages', null);
    if (messages) {
      error.messages = messages;
    }
    return Promise.reject(error);
  }
);

export default service;
