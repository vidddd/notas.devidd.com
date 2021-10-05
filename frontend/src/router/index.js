import Vue from "vue";
import VueRouter from "vue-router";
import VuePageTitle from "vue-page-title";
import VueConfirmDialog from 'vue-confirm-dialog';
import Notas from "../components/Notas.vue";
import Nota from "../components/Nota.vue";
import Login from "../views/Login.vue";
import Welcome from "../views/Welcome.vue";
/* eslint-disable */
Vue.use(VueRouter);
Vue.use(VuePageTitle);
Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)

const routes = [
  {
    path: "/welcome",
    name: "Welcome",
    component: Welcome,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/",
    name: "Notas",
    component: Notas,
          children: [{
            name: 'Nota',
            path: '/nota/:id/:token',
            component: Nota
          }],
  },
      // otherwise redirect to home
  { path: '*', redirect: '/' }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;


router.beforeEach((to, from, next) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('token');

  if (authRequired && !loggedIn) {
    return next('/login');
  }

  next();
})