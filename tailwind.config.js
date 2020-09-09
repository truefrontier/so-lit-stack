module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
  },
  purge: ['./resources/**/*.js', './resources/**/*.html', './resources/**/*.php'],
  theme: {
    extend: {},
    breakpointHelper: {
      selector: 'html.local body',
    },
    goldenRatio: {
      useCssVars: process.env.NODE_ENV !== 'production',
    },
  },
  variants: {},
  plugins: [require('tailwindcss-breakpoint-helper'), require('tailwindcss-golden-ratio')],
};
