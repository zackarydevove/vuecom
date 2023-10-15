import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Login from './components/Login.vue';
import Signup from './components/Signup.vue';
import Product from './components/Product.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
  { path: '/login', component: Login },
  { path: '/signup', component: Signup },
  { path: '/product', component: Product },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
