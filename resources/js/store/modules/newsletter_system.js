import axios from 'axios'

// state
export const state = {
  listOfCampaigns: [],
  listOfSubscribers: [],
  newsletterReportKpi: [],
  listOfNewsletterLogs: []
  // statistics: []
}

// getters
export const getters = {
  listOfCampaigns: (state) => state.listOfCampaigns,
  listOfSubscribers: (state) => state.listOfSubscribers,
  newsletterReportKpi: (state) => state.newsletterReportKpi,
  listOfNewsletterLogs: (state) => state.listOfNewsletterLogs
  // statistics: (state) => state.statistics
}

// mutations
export const mutations = {
  setListOfCampaigns: (state, listOfCampaigns) => (state.listOfCampaigns = listOfCampaigns),
  setListOfSubscribers: (state, listOfSubscribers) => (state.listOfSubscribers = listOfSubscribers),
  setNewsletterReportKpi: (state, newsletterReportKpi) => (state.newsletterReportKpi = newsletterReportKpi),
  setListOfNewsletterLogs: (state, listOfNewsletterLogs) => (state.listOfNewsletterLogs = listOfNewsletterLogs)
  // setStatistics: (state, statistics) => (state.statistics = statistics)
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
  async fetchNewsletterReportKpi ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/newsletter/kpi'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setNewsletterReportKpi', response.data)
      })
      .catch(({ response }) => {
        commit('setNewsletterReportKpi', response.data)
      })
  },
  async fetchListOfNewsletterLogs ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/newsletter/logs'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setListOfNewsletterLogs', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfNewsletterLogs', response.data)
      })
  }
  // async fetchStatistics ({ commit }) {
  //   const url = window.location.origin
  //   const apiEndPoint = '/api/admin/system/newsletter/kpi/statistics'
  //   const fullApiUrl = url + apiEndPoint
  //   axios
  //     .get(fullApiUrl)
  //     .then(response => {
  //       commit('setStatistics', response.data)
  //     })
  //     .catch(({ response }) => {
  //       commit('setStatistics', response.data)
  //     })
  // }
}
