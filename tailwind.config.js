module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        width: {
            '128': '32rem',
            '192': '48rem',
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
