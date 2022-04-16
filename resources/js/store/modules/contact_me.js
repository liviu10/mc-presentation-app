import axios from 'axios'

// state
export const state = {
  listOfMessages: []
}

// getters
export const getters = {
  listOfMessages: (state) => state.listOfMessages
}

// mutations
export const mutations = {
  setListOfMessages: (state, listOfMessages) => (state.listOfMessages = listOfMessages)
}

// actions
export const actions = {
  async fetchListOfMessages ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/contact-me'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfMessages', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfMessages', response.data)
      })
  }
}
