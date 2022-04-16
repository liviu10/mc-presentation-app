import axios from 'axios'

// state
export const state = {
  listOfErrorsAndNotifications: []
}

// getters
export const getters = {
  listOfErrorsAndNotifications: (state) => state.listOfErrorsAndNotifications
}

// mutations
export const mutations = {
  setListOfErrorsAndNotifications: (state, listOfErrorsAndNotifications) => (state.listOfErrorsAndNotifications = listOfErrorsAndNotifications)
}

// actions
export const actions = {
  async fetchListOfErrorsAndNotifications ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/errors-and-notifications'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfErrorsAndNotifications', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfErrorsAndNotifications', response.data)
      })
  }
}
