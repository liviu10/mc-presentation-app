<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-video-article">
        <div class="lv-pg-video-article-header">
          <h1>{{ blogArticleTitle }}</h1>
        </div>
        <div class="lv-pg-video-article-body">
          <!-- VIDEO ARTICLE TEMPLATE, SECTION START -->
          <video-player-article v-if="displaySingleBlogArticle" :article-content="displaySingleBlogArticle" />
          <!-- VIDEO ARTICLE TEMPLATE, SECTION END -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import VideoPlayerArticle from './templates/video-article/VideoPlayerArticle.vue'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'VideoArticlesComponent',
  components: {
    VideoPlayerArticle
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
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
