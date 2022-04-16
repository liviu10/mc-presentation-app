import axios from 'axios'

// state
export const state = {
  listOfAcceptedDomains: []
}

// getters
export const getters = {
  listOfAcceptedDomains: (state) => state.listOfAcceptedDomains
}

// mutations
export const mutations = {
  setListOfAcceptedDomains: (state, listOfAcceptedDomains) => (state.listOfAcceptedDomains = listOfAcceptedDomains)
}

// actions
export const actions = {
  async fetchListOfAcceptedDomains ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/accepted-domains'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfAcceptedDomains', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfAcceptedDomains', response.data)
      })
  }
}
