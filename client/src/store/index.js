import { createStore } from 'vuex'
import auth from './auth'
import files from './files'
import usage from './usage'

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
      files,
      usage
  }
})
