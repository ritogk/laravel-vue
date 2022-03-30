import { User } from '@/open_api';

const userModel: User = {
  id: 1,
  name: '山田太郎',
  email: 'test@example.com',
  selfPr: 'Excelが得意です。',
  tel: '011-1111-2222',
  createdAt: new Date('2020-01-01'),
  updatedAt: new Date('2020-01-01'),
};

export { userModel };
