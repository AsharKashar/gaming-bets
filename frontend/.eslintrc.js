module.exports = {
  "root":true,
  "env": {
    "browser": true,
    "es6": true,
    "amd": true,
    "node": true
  },
  "plugins": [
    "vue"
  ],
  "extends": [
    "plugin:vue/recommended",
    "prettier",
    "eslint:recommended"
  ],
  "parserOptions": {
    "parser": "babel-eslint",
    "ecmaVersion": 7,
    "sourceType": "module",
    "ecmaFeatures": {
      "globalReturn": false,
      "impliedStrict": false,
      "jsx": false,
      "experimentalObjectRestSpread": false,
      "allowImportExportEverywhere": false,
    },
  },
  "rules": {
    "indent": [
      "error",
      2,
      { "SwitchCase": 1 }
    ],
    "linebreak-style": [
      "error",
      "unix"
    ],
    "quotes": [
      "error",
      "single"
    ],
    "semi": [
      "error",
      "always"
    ],
    "no-console": "off",
    "vue/no-v-html": "off"
  }
};
