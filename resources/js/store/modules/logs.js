import axios from 'axios'

// state
export const state = {
  listOfLogs: []
}

// getters
export const getters = {
  listOfLogs: (state) => state.listOfLogs
}

// mutations
export const mutations = {
  setListOfLogs: (state, listOfLogs) => (state.listOfLogs = listOfLogs)
}

// actions
export const actions = {
  async fetchListOfLogs ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/logs'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfLogs', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfLogs', response.data)
      })
  }
}
