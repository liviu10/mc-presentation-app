import axios from 'axios'

// state
export const state = {
  blogCategoriesAndSubcategories: [],
  listOfWrittenArticles: [],
  listOfAudioArticles: [],
  listOfVideoArticles: [],
  adminBlogCategoriesAndSubcategories: []
}

// getters
export const getters = {
  allBlogCategoriesAndSubcategories: (state) => state.blogCategoriesAndSubcategories,
  listOfWrittenArticles: (state) => state.listOfWrittenArticles,
  listOfAudioArticles: (state) => state.listOfAudioArticles,
  listOfVideoArticles: (state) => state.listOfVideoArticles,
  adminAllBlogCategoriesAndSubcategories: (state) => state.adminBlogCategoriesAndSubcategories
}

// mutations
export const mutations = {
  setBlogCategoriesAndSubcategories: (state, blogCategoriesAndSubcategories) => (state.blogCategoriesAndSubcategories = blogCategoriesAndSubcategories),
  setListOfWrittenArticles: (state, listOfWrittenArticles) => (state.listOfWrittenArticles = listOfWrittenArticles),
  setListOfAudioArticles: (state, listOfAudioArticles) => (state.listOfAudioArticles = listOfAudioArticles),
  setListOfVideoArticles: (state, listOfVideoArticles) => (state.listOfVideoArticles = listOfVideoArticles),
  setAdminBlogCategoriesAndSubcategories: (state, adminBlogCategoriesAndSubcategories) => (state.adminBlogCategoriesAndSubcategories = adminBlogCategoriesAndSubcategories)
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
        commit('setBlogCategoriesAndSubcategories', response.data)
      })
      .catch(({ response }) => {
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
        commit('setListOfWrittenArticles', response.data)
      })
      .catch(({ response }) => {
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
        commit('setListOfAudioArticles', response.data)
      })
      .catch(({ response }) => {
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
        commit('setListOfVideoArticles', response.data)
      })
      .catch(({ response }) => {
        commit('setListOfVideoArticles', response.data)
      })
  },
  async fetchAdminBlogCategoriesAndSubcategories ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/blog/categories-and-subcategories'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setAdminBlogCategoriesAndSubcategories', response.data)
      })
      .catch(({ response }) => {
        commit('setAdminBlogCategoriesAndSubcategories', response.data)
      })
  }
}
