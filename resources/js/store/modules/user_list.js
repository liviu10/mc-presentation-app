import axios from 'axios'

// state
export const state = {
  listOfUsers: []
}

// getters
export const getters = {
  listOfUsers: (state) => state.listOfUsers
}

// mutations
export const mutations = {
  setListOfUsers: (state, listOfUsers) => (state.listOfUsers = listOfUsers)
}

// actions
export const actions = {
  async fetchListOfUsers ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/user-list'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfUsers', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfUsers', response.data)
      })
  }
}
