import Vue from 'vue';
import Example from './components/ExampleComponent.vue';
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo);




const app = new Vue({
    el: '#app',
    components:{
        'example':Example
    }
    
});