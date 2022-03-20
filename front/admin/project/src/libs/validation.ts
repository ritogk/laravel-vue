/**
 * バリデーションのエラーメッセージの型
 */
type validaitonErrorsType = {
  errors: {
    [index: string]: string[];
  };
};

/**
 * * バリデーションエラーの型かどうかの判定を行います。
 * @param item
 * @returns
 */
// eslint-disable-next-line
const isValidaitonErrorsType = (item: any): item is validaitonErrorsType => {
  return !!(item as validaitonErrorsType)?.errors;
};

export { validaitonErrorsType, isValidaitonErrorsType };
