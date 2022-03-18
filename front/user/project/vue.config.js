module.exports = {
  devServer: {
    port: 8080,
    allowedHosts: 'all',
  },
  publicPath:
    process.env.NODE_ENV === 'production' ? '/production-sub-path/' : '/',
  // キャッシュバスティングのためにファイル名にハッシュをつけている。
  filenameHashing: true,
};
