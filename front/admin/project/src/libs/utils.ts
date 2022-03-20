import { validaitonErrorsType } from '@/libs/type';
/**
 * 数値にカンマを付与した形に整形する
 * @param num
 * @returns string
 */
const convertComma = (num: number): string => {
  return num.toLocaleString();
};

/**
 * File → Blobの変換を行います。
 * input(type=file)で選択したファイルをFormDataを使用して送信する場合等で使用します。
 * @param file
 * @returns
 */
const fileToBlob = async (file: File) =>
  new Blob([new Uint8Array(await file.arrayBuffer())], {
    type: file.type,
  });

/**
 * バリデーションエラーの型かどうかの判定を行います。
 * @param item
 * @returns
 */
const isValidaitonErrorsType = (item: any): item is validaitonErrorsType => {
  return !!(item as validaitonErrorsType)?.errors;
};

export { convertComma, fileToBlob, isValidaitonErrorsType };
