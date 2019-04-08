import Vue from "vue";
import Vuex from "vuex";
import router from "../router";

Vue.use(Vuex);

export const errorPlugin = (store) => {
  store.subscribe((mutation, state) => {
    console.log(mutation, state);
  })
}

export default new Vuex.Store({
  state: {
    logined: localStorage.getItem('vue_token') ? true : false,
    error: false
  },
  mutations: {
    logined(state, payload) {
      state.logined = true;
    },
    apiError(state, payload) {
      router.push("/login");
    },
    error(state, payload) {
      router.push("/login");
    }
  },
  getters: {
    logined: state => state.logined,
  },
  plugins: [errorPlugin]
});