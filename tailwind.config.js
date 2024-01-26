/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./admin/**/*.{html,js,php}", 
    "./*.{html,js,php}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

