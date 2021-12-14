<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-subcategories">
        <div class="lv-pg-subcategories-header">
          <h1>LISTA ARTICOLELOR AUDIO DIN SUBCATEGORIA X</h1>
        </div>
        <div class="lv-pg-subcategories-body" />
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
  name: 'AudioArticleSubcategories',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryAudioArticles: null
    }
  },
  computed: {
    capitalizePageTitle () {
      const pageTitle = this.$t('user.blog_system_pages.audio_article_blog_pages.page_title')
      return pageTitle.toUpperCase()
    }
  },
  mounted () {
    this.getAllBlogSubcategoryAudioArticles()
  },
  methods: {
    getAllBlogSubcategoryAudioArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/categories-and-subcategories'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-audio-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a list of all audio articles for a given blog subcategory <<<<<', response.data)
          this.displayAllBlogSubcategoryAudioArticles = response.data.results[0]
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.audio_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
