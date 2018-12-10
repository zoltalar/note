window.Vue = require('vue')
window.axios = require('axios')

Vue.component('app', require('./components/app'))
Vue.component('add-note', require('./components/add-note'))

const app = new Vue({
    el: '#root',
    template: '<app></app>'
})