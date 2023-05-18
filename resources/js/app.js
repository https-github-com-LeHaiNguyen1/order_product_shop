import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import FlashMessage from '@smartweb/vue-flash-message';

Vue.use(FlashMessage);
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App),
});
