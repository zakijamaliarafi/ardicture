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
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

