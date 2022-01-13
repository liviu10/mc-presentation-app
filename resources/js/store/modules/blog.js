import axios from 'axios'

// state
export const state = {
  blogCategoriesAndSubcategories: [],
  listOfWrittenArticles: [],
  listOfAudioArticles: [],
  listOfVideoArticles: []
}

// getters
export const getters = {
  allBlogCategoriesAndSubcategories: (state) => state.blogCategoriesAndSubcategories,
  listOfWrittenArticles: (state) => state.listOfWrittenArticles,
  listOfAudioArticles: (state) => state.listOfAudioArticles,
  listOfVideoArticles: (state) => state.listOfVideoArticles
}

// mutations
export const mutations = {
  setBlogCategoriesAndSubcategories: (state, blogCategoriesAndSubcategories) => (state.blogCategoriesAndSubcategories = blogCategoriesAndSubcategories),
  setListOfWrittenArticles: (state, listOfWrittenArticles) => (state.listOfWrittenArticles = listOfWrittenArticles),
  setListOfAudioArticles: (state, listOfAudioArticles) => (state.listOfAudioArticles = listOfAudioArticles),
  setListOfVideoArticles: (state, listOfVideoArticles) => (state.listOfVideoArticles = listOfVideoArticles)
}

// actions
export const actions = {
  async fetchBlogCategoriesAndSubcategories ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/blog/categories-and-subcategories'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> Display blog categories and subcategories: ')
        commit('setBlogCategoriesAndSubcategories', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ')
        commit('setBlogCategoriesAndSubcategories', response.data)
      })
  },
  async fetchListOfWrittenArticles ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/blog/articles/all-written-articles'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> List of written blog articles: ')
        commit('setListOfWrittenArticles', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ')
        commit('setListOfWrittenArticles', response.data)
      })
  },
  async fetchListOfAudioArticles ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/blog/articles/all-audio-articles'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> List of audio blog articles: ')
        commit('setListOfAudioArticles', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ')
        commit('setListOfAudioArticles', response.data)
      })
  },
  async fetchListOfVideoArticles ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/blog/articles/all-video-articles'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        console.log('>>>>> List of video blog articles: ')
        commit('setListOfVideoArticles', response.data)
      })
      .catch(({ response }) => {
        console.log('>>>>>> Http request error: ')
        commit('setListOfVideoArticles', response.data)
      })
  }
}
