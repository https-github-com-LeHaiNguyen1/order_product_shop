import Vue from 'vue';
import VueRouter from 'vue-router';
import Welcome from './views/Welcome.vue';

Vue.use(VueRouter);

const routes = [
  
  {
    path: '/',
    name: 'welcome',
    component: Welcome,
  },
  {
    path: '/product',
    name: 'product',
    component: () => import('./views/Admin/Products/index.vue')
  },
]

// Create Vue Router Object
const router = new VueRouter({
  routes : routes
});

export default router;