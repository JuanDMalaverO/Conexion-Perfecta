/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'index.php',
    'View/php/usuarios.php',
    'Controller/editar_usuario.php'
  ],
  theme: {
    extend: {
      colors: {
        'gray-900': '#1a1a1a',
        'gray-800': '#2c2c2c',
        'gray-700': '#3d3d3d',
        'green-500': '#10b981',
        'yellow-500': '#f59e0b',
        'blue-500': '#3b82f6',
        'red-500': '#ef4444',
      },
      fontFamily: {
        'sans': ['Inter', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

