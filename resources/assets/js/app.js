
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Landing from './views/Landing'
import LeftMenu from './views/leftmenu'
import CategoriesIndex from './views/CategoriesIndex'

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('prop-component', require('./components/PropComponent.vue'));
Vue.component('ajax-component', require('./components/AjaxComponent.vue'));
Vue.component('chartline-component', require('./components/ChartlineComponent.vue'));
Vue.component('chartpie-component', require('./components/ChartpieComponent.vue'));
Vue.component('chartrandom-component', require('./components/ChartrandComponent.vue'));
Vue.component('chartsocket-component', require('./components/SocketComponent.vue'));
Vue.component('chat-socket-component', require('./components/SocketChatComponent.vue'));

import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/beletag',
            name: 'beletag.index',
            component: LeftMenu,
        },
    ],
});

$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items:1,
        URLhashListener:true,
        mouseDrag:false
    })
})

const app = new Vue({
    el: '#app',
    components: { 
    	'monitoring-stores' : Landing,
    },
});