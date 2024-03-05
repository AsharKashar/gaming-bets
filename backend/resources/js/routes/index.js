import auth from 'Routes/auth';
import errors from 'Routes/errors';
import home from 'Routes/home';
import profile from 'Routes/profile';
import about from 'Routes/about';
import coins from 'Routes/coins';
import leaderboards from 'Routes/leaderboards';
import membership from 'Routes/membership';
import sponsors from 'Routes/sponsors';
import game from 'Routes/game';

let routeFiles = [];

const routes = routeFiles.concat(
  auth,
  errors,
  home,
  profile,
  about,
  coins,
  leaderboards,
  membership,
  sponsors,
  game
);

export default routes;
