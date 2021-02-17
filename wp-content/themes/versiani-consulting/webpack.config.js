const path = require('path');
const webpack = require('webpack');

// Webpack configuration used in the JS gulp task
module.exports = {
  output: {
    filename: '[name].dist.js',
    path: path.resolve(__dirname, './'),
  },
  module: {
    rules: [
      {
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
            },
          },
        ],
      },
    ],
  },
  externals: {
    jquery: 'jQuery', // Allow to import jQuery externally
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      swiper: 'swiper',
    }),
  ],
  devtool: 'none', // Source Map settings
  mode: 'production', // Use --dev flag in the gulp tasks to 'development' mode
};
