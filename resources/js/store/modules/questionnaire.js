import axios from 'axios'

// state
export const state = {
  questionnaires: [],
  singleQuestionnaire: []
}

// getters
export const getters = {
  allQuestionnaires: (state) => state.questionnaires,
  singleQuestionnaire: (state) => state.singleQuestionnaire
}

// mutations
export const mutations = {
  setQuestionnaires: (state, questionnaires) => (state.questionnaires = questionnaires),
  setSingleQuestionnaires: (state, singleQuestionnaire) => (state.singleQuestionnaire = singleQuestionnaire)
}

// actions
export const actions = {
  async fetchQuestionnaires ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/schedule-appointment/questionnaire'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> Display all available questionnaires: ')
        commit('setQuestionnaires', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ', response.data)
        commit('setQuestionnaires', response.data)
      })
  },
  async fetchSingleQuestionnaire ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/schedule-appointment/questionnaire'
    const fullApiUrl = url + apiEndPoint + '/' + this.state.route.params.id
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> Display single questionnaire: ')
        commit('setSingleQuestionnaires', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ', response.data)
        commit('setSingleQuestionnaires', response.data)
      })
  }
}
