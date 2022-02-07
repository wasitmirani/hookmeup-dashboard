import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
      User:null
    },
    auth: {
      user (user) {
        return window.auth_user;
      }
    }
  })
