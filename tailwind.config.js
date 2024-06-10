/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'white': '#ffffff',
        'ardicture-orange': '#f14902',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

