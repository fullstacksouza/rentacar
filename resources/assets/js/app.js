import Vue from 'vue';

import VeeValidate from 'vee-validate';
// import VueRouter from 'vue-router'

// Vue.use(VueRouter)
window.VeeValidate = require('vee-validate');

Vue.use(window.VeeValidate);
import Example from './components/ExampleComponent.vue';
import ReplySearchComponent from './components/ReplySearchComponent.vue';
import TypeQuestions from './components/TypeOfQuestionsComponent.vue';
import EditSearchComponent from './components/EditSearchComponent.vue';
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo);

Vue.component('type-question', TypeQuestions);
Vue.component('search', ReplySearchComponent);

const app = new Vue({
    el: '#app',
    components: {
        'example': Example,
        'type-question': TypeQuestions,
        'search': ReplySearchComponent,
        'edit-search': EditSearchComponent
    },



});
