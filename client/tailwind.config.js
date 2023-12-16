module.exports = {
    content: ['./src/renderer/**/*.{js,jsx,ts,tsx,ejs}'],
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
              100:"#FBE6EA"
            } ,
            'grey': {
              700:"#828282",
              600:"#BDBDBD",
              500:"#E0E0E0",
              400:"#F2F5F7"
            },
            'green': "#2B9355",
            'white':"#FFFFFF",
            'black':'#242424',
            'transparent': 'transparent',
          }
        },
      },
    variants: {},
    plugins: []
  };