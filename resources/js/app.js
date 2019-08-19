/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import store from './store';

Vue.use(BootstrapVue); // BoostraVue
// window.eventBus = new Vue();

Vue.component('contact-form-component', require('./components/ContactFormComponent').default);

Vue.component('profile-component', require('./components/ProfileFormComponent.vue').default);

Vue.component('messenger-component', require('./components/MessengerComponent.vue').default);

Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue').default);
Vue.component('contact-component', require('./components/ContactComponent.vue').default);

Vue.component('contact-list-component', require('./components/ContactListComponent.vue').default);
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue').default);

Vue.component('status-component', require('./components/StatusComponent.vue').default);

const app = new Vue({
    el: '#app',
    store,
    methods: {
        logout() {
            document.getElementById('logout-form').submit();
        }
    }
});