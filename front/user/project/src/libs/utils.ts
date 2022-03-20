/**
 * 数値にカンマを付与した形に整形する
 * @param num
 * @returns string
 */
const convertComma = (num: number): string => {
  return num.toLocaleString();
};

export { convertComma };
