module.exports = {
  devServer: {
    allowedHosts: 'all',
  },
  publicPath:
    process.env.NODE_ENV === 'production' ? '/production-sub-path/' : '/',
  // キャッシュバスティングのためにファイル名にハッシュをつけている。
  filenameHashing: true,
};
