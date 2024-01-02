import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/dashboard.vue';
import Home from './components/home.vue';
import Detilkrs from './components/Detilkrs.vue';
import Mahasiswa from './components/Mahasiswa.vue';
import MataKuliah from './components/MataKuliah.vue';
import Agama from './components/Agama.vue';
import Krs from './components/Krs.vue';
// import sidebar from './components/sidebar.vue';

// Create home.vue and other components as needed

const routes = [
  { path: '/', component: Login },
  { path: '/register', component: Register },
  { path: '/home', name: 'HomePage', component: Home, meta: { requiresAuth: true } },
  { path: '/detilkrs', component: Detilkrs, meta: { requiresAuth: true } },
  { path: '/mahasiswa', component: Mahasiswa, meta: { requiresAuth: true } },
  { path: '/matakuliah', component: MataKuliah, meta: { requiresAuth: true } },
  { path: '/agama', component: Agama, meta: { requiresAuth: true } },
  { path: '/krs', component: Krs, meta: { requiresAuth: true } },
//   { path: '/sidebar', name: 'sidebar', component: sidebar, meta: { requiresAuth: true } },
  
  // Add more routes as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation guard for authentication
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // Check if the route requires authentication
    // Redirect to login if not authenticated
    if (!localStorage.getItem('token')) {
      next({ path: '/' });
    } else {
      next(); // Continue to the route
    }
  } else {
    next(); // Continue to the route
  }
});

const app = createApp(App);

// Use the router in your app
app.use(router);

// Mount the app
app.mount('#app');
