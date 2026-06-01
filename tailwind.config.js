export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#5CC6E7',
        secondary: '#39C3E6',
        success: '#22C55E',
        warning: '#F59E0B',
        danger: '#EF4444',
        light: '#F5F5F5',
      },

      boxShadow: {
        card: '0 4px 10px rgba(0,0,0,0.08)',
      },

      borderRadius: {
        xl2: '16px',
        xl3: '20px',
      },

      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      }
    },
  },
  plugins: [],
}