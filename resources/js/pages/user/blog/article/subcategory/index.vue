<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-subcategories">
        <div class="lv-con-pg-subcategories-title">
          <h1>LISTA ARTICOLELOR DIN SUBCATEGORIA X</h1>
        </div>
        <div class="lv-con-pg-subcategories-view" />
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'WrittenArticleSubcategoriesPage',
  components: {},
  layout: '',
  middlewa: '',
  props: {},
  data: function () {
    return {
      displayBlogCategoriesAndSubcategories: null
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {
    this.getBlogCategoriesAndSubcategories()
  },
  methods: {
    getBlogCategoriesAndSubcategories: function () {
      const url = window.location.origin
      const blogCategoriesAndSubcategoriesApi = url + '/api/blog-configuration/categories-and-subcategories'
      axios
        .get(blogCategoriesAndSubcategoriesApi)
        .then(response => {
          console.log('>>>>> Blog Categories and Subcategories Api Data', response.data)
          this.displayBlogCategoriesAndSubcategories = response.data.results
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.article_blog_page.page_title') }
  }
}
</script>
