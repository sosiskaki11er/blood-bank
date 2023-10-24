/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{js,jsx}"
  ],
  theme: {
    extend: {
      fontSize: {
        xs:"1.4rem",
        sm:"1.6rem",
        base:"1.8rem",
        lg:"2.0rem",
        xl:"2.4rem",
        "2xl":"3.2rem"
      },
      colors: {
        'red':{
          600:"#D21F3C",
        } ,
        'grey': {
          700:"#828282",
          500:"#E0E0E0",
        },
        'white':"#FFFFFF",
        'black':'#242424',
        'transparent': 'transparent',
      }
    },
  },
  plugins: [],
}

