<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-audio-article">
        <div class="lv-pg-audio-article-header">
          <h1>{{ blogArticleTitle }}</h1>
        </div>
        <div class="lv-pg-audio-article-body">
          <!-- AUDIO ARTICLE TEMPLATE, SECTION START -->
          <audio-player-article v-if="displaySingleBlogArticle" :article-content="displaySingleBlogArticle" />
          <!-- AUDIO ARTICLE TEMPLATE, SECTION END -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import AudioPlayerArticle from './templates/audio-article/AudioPlayerArticle.vue'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'AudioArticlesComponent',
  components: {
    AudioPlayerArticle
  },
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displaySingleBlogArticle: null,
      blogArticleTitle: ''
    }
  },
  mounted () {
    this.getSingleBlogArticle()
  },
  methods: {
    getSingleBlogArticle: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          this.displaySingleBlogArticle = response.data.records[0]
          this.blogArticleTitle = response.data.records[0].blog_articles[0].blog_article_title
        })
        .catch(error => {
          if (error.response.status === 404) {
            this.$router.push({ name: 'not-found-page' })
          }
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.audio_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
