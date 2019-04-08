import Vue from "vue";
import Router from "vue-router";
import Top from "./views/Top.vue";
import Login from "./views/Login.vue";
import Signup from "./views/Signup.vue";
import Profile from "./views/Profile.vue";
import User from "./views/User.vue";
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
    },
    {
      path: "/signup",
      name: "signup",
      component: Signup
    },
    {
      path: "/profile",
      name: "profile",
      component: Profile
    },
    {
      path: "/user",
      name: "user",
      component: User
    }
  ]
});

// router.beforeEach((to, from, next) => {
//   console.log(to);
// });

export default router;