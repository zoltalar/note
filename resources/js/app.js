window.Vue = require('vue')

window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
}

Vue.component('app', require('./components/app'))
Vue.component('add-note', require('./components/add-note'))

const app = new Vue({
    el: '#root',
    template: '<app></app>'
})