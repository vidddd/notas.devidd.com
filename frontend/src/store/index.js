import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    username: null,
    token: null,
  },
  mutations: {
    setUser(state, username) {
      state.username = username;
    },
    setToken(state, token) {
      state.token = token;
    },
  },
  actions: {},
  getters: {
    isLoggedIn(state) {
      return !state.token;
    },
    getToken(state) {
      return state.token
    }
  },
});