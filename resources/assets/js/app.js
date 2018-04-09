import Vue from 'vue';
import Example from './components/ExampleComponent.vue';





const app = new Vue({
    el: '#app',
    components:{
        'example':Example
    },
    router
});