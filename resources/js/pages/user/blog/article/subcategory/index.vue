<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-subcategories">
        <div class="lv-pg-subcategories-header">
          <h1>LISTA ARTICOLELOR DIN SUBCATEGORIA X</h1>
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
  name: 'BlogSubcategoryWrittenArticles',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryWrittenArticles: null
    }
  },
  mounted () {
    this.getAllBlogSubcategoryWrittenArticles()
  },
  methods: {
    getAllBlogSubcategoryWrittenArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/subcategory/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-written-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a list of all written articles for a given blog subcategory <<<<<')
          this.displayAllBlogSubcategoryWrittenArticles = response.data.records[0]
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
