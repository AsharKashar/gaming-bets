const config = require('./config');

module.exports = {
  broadcaster: 'socket.io',
  host: config.ECHO_HOST,
  path: '/ws/socket.io',
  auth: {
    username: config.BASE_AUTH_LOGIN,
    password: config.BASE_AUTH_PASSWORD,
  },
};
