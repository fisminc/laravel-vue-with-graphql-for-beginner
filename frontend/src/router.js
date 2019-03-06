import Vue from "vue";
import Router from "vue-router";
import Top from "./views/Top.vue";
import Login from "./views/Login.vue";
import store from "./store/index";

Vue.use(Router);

const AuthGuard = (to, from, next) => {
  if (!store.getters.logined) {
    next({
      path: "/login"
    });
  } else {
    next();
  }
};

const router = new Router({
  routes: [
    {
      path: "/",
      name: "top",
      component: Top,
      beforeEnter: AuthGuard
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