import { JobCategory } from '@/open_api';

const jobCategoryModel1: JobCategory = {
  id: 1,
  name: '公務員',
  content: '役所、消防署、官僚、国税専門官',
  image: 'image/path',
  imageUrl: 'http://storage/image/path/xxxx.jpg',
  sortNo: 1,
  createdAt: new Date('2020-01-01'),
  updatedAt: new Date('2020-01-01'),
};

const jobCategoryModel2: JobCategory = {
  id: 2,
  name: '営業',
  content: 'コンサルティングフォーム、専門事務所',
  image: 'image/path',
  imageUrl: 'http://storage/image/path/xxxx.jpg',
  sortNo: 2,
  createdAt: new Date('2020-01-01'),
  updatedAt: new Date('2020-01-01'),
};

export { jobCategoryModel1, jobCategoryModel2 };
