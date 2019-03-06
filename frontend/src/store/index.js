import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    logined: false
  },
  mutations: {
    logined(state, payload) {
      state.logined = true;
    }
  },
  getters: {
    logined: state => state.logined,
  }
});