import axios from 'axios'

// state
export const state = {
  userCarouselSection: [],
  userJumbotronSection: [],
  userTestimonialSection: [],
  userFooterSection: []
}

// getters
export const getters = {
  allUserCarouselSection: (state) => state.userCarouselSection,
  allUserJumbotronSection: (state) => state.userJumbotronSection,
  allUserTestimonialSection: (state) => state.userTestimonialSection,
  allUserFooterSection: (state) => state.userFooterSection
}

// mutations
export const mutations = {
  setUserCarouselSection: (state, userCarouselSection) => (state.userCarouselSection = userCarouselSection),
  setUserJumbotronSection: (state, userJumbotronSection) => (state.userJumbotronSection = userJumbotronSection),
  setUserTestimonialSection: (state, userTestimonialSection) => (state.userTestimonialSection = userTestimonialSection),
  setUserFooterSection: (state, userFooterSection) => (state.userFooterSection = userFooterSection)
}

// actions
export const actions = {
  async fetchUserCarouselSection ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/home-page/display-carousel'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setUserCarouselSection', response.data)
      })
      .catch(({ response }) => {
        commit('setUserCarouselSection', response.data)
      })
  },
  async fetchUserJumbotronSection ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/home-page/display-jumbotron'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setUserJumbotronSection', response.data)
      })
      .catch(({ response }) => {
        commit('setUserJumbotronSection', response.data)
      })
  },
  async fetchUserTestimonialSection ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/home-page/display-testimonials'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setUserTestimonialSection', response.data)
      })
      .catch(({ response }) => {
        commit('setUserTestimonialSection', response.data)
      })
  },
  async fetchUserFooterSection ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/home-page/display-footer'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setUserFooterSection', response.data)
      })
      .catch(({ response }) => {
        commit('setUserFooterSection', response.data)
      })
  }
}
