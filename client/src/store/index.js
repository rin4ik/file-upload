import { createStore } from 'vuex'
import auth from './auth'
import files from './files'
export default createStore({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
      auth,
      files
  }
})
