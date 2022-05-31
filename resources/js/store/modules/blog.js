import axios from 'axios'

// state
export const state = {
  blogCategoriesAndSubcategories: [],
  listOfWrittenArticles: [],
  listOfAudioArticles: [],
  listOfVideoArticles: [],
  // Admin records
  blogCategories: [],
  blogSubcategories: [],
  blogArticles: [],
  blogArticleComments: []
}

// getters
export const getters = {
  allBlogCategoriesAndSubcategories: (state) => state.blogCategoriesAndSubcategories,
  listOfWrittenArticles: (state) => state.listOfWrittenArticles,
  listOfAudioArticles: (state) => state.listOfAudioArticles,
  listOfVideoArticles: (state) => state.listOfVideoArticles,
  // Admin records
  blogCategories: (state) => state.blogCategories,
  blogSubcategories: (state) => state.blogSubcategories,
  blogArticles: (state) => state.blogArticles,
  blogArticleComments: (state) => state.blogArticleComments
}

// mutations
export const mutations = {
  setBlogCategoriesAndSubcategories: (state, blogCategoriesAndSubcategories) => (state.blogCategoriesAndSubcategories = blogCategoriesAndSubcategories),
  setListOfWrittenArticles: (state, listOfWrittenArticles) => (state.listOfWrittenArticles = listOfWrittenArticles),
  setListOfAudioArticles: (state, listOfAudioArticles) => (state.listOfAudioArticles = listOfAudioArticles),
  setListOfVideoArticles: (state, listOfVideoArticles) => (state.listOfVideoArticles = listOfVideoArticles),
  // Admin records
  setBlogCategories: (state, blogCategories) => (state.blogCategories = blogCategories),
  setBlogSubcategories: (state, blogSubcategories) => (state.blogSubcategories = blogSubcategories),
  setBlogArticles: (state, blogArticles) => (state.blogArticles = blogArticles),
  setBlogArticleComments: (state, blogArticleComments) => (state.blogArticleComments = blogArticleComments)
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
  // Admin records
  async fetchBlogCategories ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/blog/display-categories'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setBlogCategories', response.data)
      })
      .catch(({ response }) => {
        commit('setBlogCategories', response.data)
      })
  },
  async fetchBlogSubcategories ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/blog/display-subcategories'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setBlogSubcategories', response.data)
      })
      .catch(({ response }) => {
        commit('setBlogSubcategories', response.data)
      })
  },
  async fetchBlogArticles ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/blog/display-articles'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setBlogArticles', response.data)
      })
      .catch(({ response }) => {
        commit('setBlogArticles', response.data)
      })
  },
  async fetchBlogArticleComments ({ commit }) {
    const url = window.location.origin
    const apiEndPoint = '/api/admin/system/blog/articles/' + blogArticleId + '/comments'
    const fullApiUrl = url + apiEndPoint
    axios
      .get(fullApiUrl)
      .then(response => {
        commit('setBlogArticleComments', response.data)
      })
      .catch(({ response }) => {
        commit('setBlogArticleComments', response.data)
      })
  }
}
