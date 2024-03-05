import auth from 'Modules/auth'
import Vue from 'vue'

// Create axios instance
const service = window.axios.create({
  withCredentials: true,
  baseURL: '/api',
  timeout: 10000, // Request timeout
})

// Request intercepter
service.interceptors.request.use(
  config => {
    if (auth.getters.isAuthenticated()) {
      config.headers['Authorization'] = 'Bearer ' + auth.getters.getToken() // Set JWT token
    }
    return config
  },
  error => {
    // Do something with request error
    console.log(error) // for debug
    Promise.reject(error)
  },
)

// response pre-processing
service.interceptors.response.use(
  response => {
    return response
  },
  error => {
    let message = error.message
    if (error.response.data && error.response.data.errors) {
      message = error.response.data.errors
    } else if (error.response.data && error.response.data.error) {
      message = error.response.data.error
    }
    if (error.response.status === 404) {
      Vue.notify({
        group: 'error',
        title: 'Server error',
        text: 'Not found',
        type: 'error',
      })
    }

    if (error.response.status === 403) {
      Vue.notify({
        group: 'error',
        title: 'Not logged in',
        text: 'Login again',
        type: 'error',
      })
      // location.reload()
    }

    if (error.response.status === 500) {
      Vue.notify({
        group: 'error',
        title: 'Server error',
        text: 'Try again',
        type: 'error',
      })
      // location.reload()
    }

    Vue.notify({
      group: 'error',
      title: 'Error ' + error.response.status,
      type: 'error',
      text: message,
    })

    return Promise.reject(error)
  },
)

export default service
