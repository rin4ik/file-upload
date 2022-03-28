import { createStore } from 'vuex'
import auth from './auth'
import files from './files'
import usage from './usage'
import snack from './snack'

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
      usage,
      snack
  }
})
