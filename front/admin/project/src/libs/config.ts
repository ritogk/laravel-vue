import { Configuration } from '@/open_api';

const apiConfig = new Configuration({
  basePath: process.env.VUE_APP_API_BASE_URL,
  credentials: 'include',
});

export { apiConfig };
