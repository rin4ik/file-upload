export default {
    namespaced: true, 
    state: {
        snack: null
    },
    getters: {
        snack(state) {
          return state.snack
        }
    },
    mutations: { 
        SET_SNACK(state, text) {
            state.snack = text
        }
    },
    actions: { 
        snack({commit}, text) {
            commit('SET_SNACK', text)
            setTimeout(() => {
                commit('SET_SNACK', null)
            }, 5000);
        }
    },
}
