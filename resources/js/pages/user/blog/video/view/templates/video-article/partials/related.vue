<template>
  <div v-if="displayRelatedVideoArticles" class="article-related">
    <h1>{{ $t('user.blog_system_pages.general_settings.related_articles.title') }}</h1>
    <div v-for="relatedVideoArticle in displayRelatedVideoArticles.blog_articles" :key="relatedVideoArticle.id" class="card">
      <div class="card-body">
        <img src="/images/blog/audio-player-img.jpg" class="card-img-top" :alt="relatedVideoArticle.blog_article_title">
      </div>
      <div class="card-body">
        <p class="card-text">
          <a :href="relatedVideoArticle.blog_article_path + '/' + relatedVideoArticle.id">
            {{ relatedVideoArticle.blog_article_title }}
          </a>
        </p>
        <p class="card-text">
          {{ relatedVideoArticle.blog_article_short_description }}
        </p>
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
  name: 'RelatedDetails',
  props: {
    blogRelatedArticles: {
      default: null,
      type: Object
    }
  },
  data: function () {
    return {
      displayRelatedVideoArticles: null
    }
  },
  mounted () {
    this.getRelatedVideoArticles()
  },
  methods: {
    getRelatedVideoArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/related/video-articles'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + '/' + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          this.displayRelatedVideoArticles = response.data.records[0]
        })
        .catch(error => {
          console.log(error.response)
        })
    }
  }
}
</script>
