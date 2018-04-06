import Vue from 'vue';
import VueRouter from 'vue-router';
import Example from './components/ExampleComponent.vue';
Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
      {
        path: 'admin/search/:searcId/questions/create',
        name: 'create-qeustions',
        component: Example
      }
    ]
  });

const app = new Vue({
    el: '#app',
    components:{
        'example':Example
    },
    router
})