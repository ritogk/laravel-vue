import { Configuration } from '@/open_api';

const apiConfig = new Configuration({
  basePath: process.env.API_URL_BASE,
});

export { apiConfig };
