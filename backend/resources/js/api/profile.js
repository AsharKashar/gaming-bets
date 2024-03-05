import request from 'Services/request';

export function getMe() {
  return request({
    url: '/profile/get-me',
    method: 'get',
    params: {}
  });
}

export function ChangePassword(query) {
  return request({
    url: '/profile/changePassword',
    method: 'post',
    params: query
  });
}

export function Update(query) {
  return request({
    url: '/profile/updateProfile',
    method: 'post',
    params: query
  });
}

export function getStats(query) {
  return request({
    url: '/profile/getStats',
    method: 'post',
    params: query
  });
}
