import axios from 'axios'

// state
export const state = {
  blogCategoriesAndSubcategories: []
}

// getters
export const getters = {
  allBlogCategoriesAndSubcategories: (state) => state.blogCategoriesAndSubcategories
}

// mutations
export const mutations = {
  setBlogCategoriesAndSubcategories: (state, blogCategoriesAndSubcategories) => (state.blogCategoriesAndSubcategories = blogCategoriesAndSubcategories)
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
        console.log('>>>>>> Http request error: ', response.data)
        commit('setBlogCategoriesAndSubcategories', response.data)
      })
  }
}
