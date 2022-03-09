import axios from 'axios'
export default {
    namespaced: true,
    state: { 
        files: []
    },
    getters: { 
        files(state) {
            return state.files
        }
    },
    mutations: { 
        SET_FILES(state, files) {
            state.files = files
        }
    },
    actions: { 
        async getFiles ({commit}) {
            let response = await axios.get('/api/files')
            commit('SET_FILES', response.data.data)
        }
    }
}
