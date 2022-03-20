import { apiConfig } from '@/libs/config';
import { FileApi, FilePath, FilesPostRequest } from '@/open_api';

// メイン関数のtype
type useFileType = {
  upload(file?: Blob): Promise<FilePath>;
};

const fileApi = new FileApi(apiConfig);

/**
 * メイン関数
 */
const useFile = (): useFileType => {
  /**
   * ファイルアップロードを行います。
   * @param file
   * @returns
   */
  const upload = async (file: Blob): Promise<FilePath> => {
    const request: FilesPostRequest = { file: file };
    const response = await fileApi.filesPost(request);
    return response;
  };

  return {
    upload: upload,
  };
};

export { useFile };
