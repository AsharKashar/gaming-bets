import request from 'Services/request';

export function getFeaturedGames() {
  return request({
    url: '/home/game-list',
    method: 'get',
    params: {}
  });
}
