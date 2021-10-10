<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-subcategories">
        <div class="lv-con-pg-subcategories-title">
          <h1>LISTA ARTICOLELOR AUDIO DIN SUBCATEGORIA X</h1>
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
  name: 'AudioArticleSubcategoriesPage',
  components: {},
  layout: '',
  middlewa: '',
  props: {},
  data: function () {
    return {
      displayAllBlogCategoriesAndSubcategories: null
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {
    this.getAllBlogMainCategoriesAndSubcategories()
  },
  methods: {
    getAllBlogMainCategoriesAndSubcategories: function () {
      const domain = window.location.origin
      const apiEndPoint = '/api/blog-configuration/categories-and-subcategories'
      const fullApiUrl = domain + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Blog Categories and Subcategories Api Data', response.data)
          this.displayAllBlogCategoriesAndSubcategories = response.data.results
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.article_blog_page.page_title') }
  }
}
</script>
