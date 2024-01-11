/** @type {import('tailwindcss').Config} */
export default {
  content: [
     "./resources/**/*.blade.php",
     "./resources/**/*.js",
     "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        maxWidth: {
            '4xl': '1200px'
        }
    },
  },
  plugins: [
     require('flowbite/plugin')
  ],
}

