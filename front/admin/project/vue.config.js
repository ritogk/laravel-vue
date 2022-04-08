module.exports = {
  devServer: {
    port: 8088,
    allowedHosts: 'all',
  },
  publicPath: process.env.NODE_ENV === 'production' ? '/' : '/',
  // キャッシュバスティングのためにファイル名にハッシュをつけている。
  filenameHashing: true,
};
