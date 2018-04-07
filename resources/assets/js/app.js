import Vue from 'vue';
import Example from './components/ExampleComponent.vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            //component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            //component: Hello,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components:{
        'example':Example
    },
    router
});