import axios from 'axios'

// state
export const state = {
  listOfCampaigns: [],
  listOfSubscribers: [],
  listOfCampaignsLogs: []
}

// getters
export const getters = {
  listOfCampaigns: (state) => state.listOfCampaigns,
  listOfSubscribers: (state) => state.listOfSubscribers,
  listOfCampaignsLogs: (state) => state.listOfCampaignsLogs
}

// mutations
export const mutations = {
  setListOfCampaigns: (state, listOfCampaigns) => (state.listOfCampaigns = listOfCampaigns),
  setListOfSubscribers: (state, listOfSubscribers) => (state.listOfSubscribers = listOfSubscribers),
  setListOfCampaignLogs: (state, listOfCampaignsLogs) => (state.listOfCampaignsLogs = listOfCampaignsLogs)
}

// actions
export const actions = {
  async fetchListOfCampaigns ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/newsletter/campaigns'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfCampaigns', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfCampaigns', response.data)
      })
  },
  async fetchListOfSubscribers ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/newsletter/subscribers'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfSubscribers', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfSubscribers', response.data)
      })
  },
  async fetchListOfCampaignLogs ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/newsletter/logs'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfCampaignLogs', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfCampaignLogs', response.data)
      })
  }
}
