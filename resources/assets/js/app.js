import Vue from 'vue';
import Example from './components/ExampleComponent.vue';
import TypeQuestions from './components/TypeOfQuestionsComponent.vue';
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo);

Vue.component('type-question',TypeQuestions);
var eventBus = new Vue();
const app = new Vue({
    el: '#app',
    components:{
        'example':Example,
        'type-question':TypeQuestions
    }
    
    
});

