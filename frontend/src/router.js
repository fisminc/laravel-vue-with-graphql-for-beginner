import Vue from "vue";
import Router from "vue-router";
import Top from "./views/Top.vue";
import Login from "./views/Login.vue";
import Vuetify from "vuetify";

Vue.use(Router);
Vue.use(Vuetify, {
  iconfont: "mdi" // 'md' || 'mdi' || 'fa' || 'fa4'
});

const router = new Router({
  routes: [
    {
      path: "/",
      name: "top",
      component: Top
    },
    {
      path: "/login",
      name: "login",
      component: Login
    }
  ]
});

// router.beforeEach((to, from, next) => {
//   console.log(to);
// });

export default router;