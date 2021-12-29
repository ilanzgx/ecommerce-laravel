module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: 'media',
  theme: {
    extend: {
      colors: {
        'army-green': '#78866b'
      }
    },
  },
  plugins: [],
  variants: {
    boxShadow: ['responsive', 'hover', 'focus'], 
  },
}
