const axios = require('axios');
const {
  BASE_URL,
  BASE_AUTH_LOGIN,
  BASE_AUTH_PASSWORD,
} = require('../configs/config');

let configuration = {
  baseURL: `${BASE_URL}/api/`,
  params: {},
  auth: {
    username: BASE_AUTH_LOGIN,
    password: BASE_AUTH_PASSWORD
  }
};

const service = axios.create(configuration);

export const getDynamicRoutes = async () => {
  const response = await service.get('dynamic-slugs');
  return response.data.data;
};

export const getRssForBlog = async (locale='en') => {
  const response = await service.get(`rss-info/${locale}`);
  return response.data.data;
};
