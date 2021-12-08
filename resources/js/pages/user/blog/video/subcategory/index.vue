<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-subcategories">
        <div class="lv-con-pg-subcategories-title">
          <h1>LISTA ARTICOLELOR VIDEO DIN SUBCATEGORIA X</h1>
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
  name: 'VideoArticleSubcategoriesPage',
  components: {},
  layout: '',
  middlewa: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryVideoArticles: null
    }
  },
  computed: {
    capitalizePageTitle () {
      const pageTitle = this.$t('user.blog_system_pages.video_article_blog_pages.page_title')
      return pageTitle.toUpperCase()
    }
  },
  mounted () {
    this.getAllBlogSubcategoryVideoArticles()
  },
  methods: {
    getAllBlogSubcategoryVideoArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/subcategory/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-video-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a list of all video articles for a given blog subcategory <<<<<', response.data)
          this.displayAllBlogSubcategoryVideoArticles = response.data.results[0]
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
