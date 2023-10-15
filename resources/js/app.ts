import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

import Navbar from './components/Navbar.vue'
import Login from './components/Login.vue'
import Signup from './components/Signup.vue'
import Product from './components/Product.vue'

createApp(App)

.component('Navbar', Navbar)
.component('Login', Login)
.component('Signup', Signup)
.component('Product', Product)

.use(router)
.use(store)


.mount("#app");