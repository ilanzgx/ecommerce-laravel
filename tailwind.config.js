module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        'army-green': '#78866b'
      }
    },
  },
  plugins: [
    //require('tailwindcss-dark-mode')()
  ],
  variants: {
    //backgroundColor: ['dark', 'dark-hover', 'dark-group-hover', 'dark-even', 'dark-odd'],
    //borderColor: ['dark', 'dark-disabled', 'dark-focus', 'dark-focus-within'],
    //textColor: ['dark', 'dark-hover', 'dark-active', 'dark-placeholder'],
    boxShadow: ['responsive', 'hover', 'focus'], 
  },
}
