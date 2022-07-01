<template>
  <div v-if="displayRelatedWrittenArticles" class="article-related">
    <h1>{{ $t('user.blog_system_pages.general_settings.related_articles.title') }}</h1>
    <div v-for="relatedWrittenArticle in displayRelatedWrittenArticles.blog_articles" :key="relatedWrittenArticle.id" class="card">
      <div class="card-body">
        <img src="/images/blog/audio-player-img.jpg" class="card-img-top" :alt="relatedWrittenArticle.blog_article_title">
      </div>
      <div class="card-body">
        <p class="card-text">
          <a :href="relatedWrittenArticle.blog_article_path + '/' + relatedWrittenArticle.id">
            {{ relatedWrittenArticle.blog_article_title }}
          </a>
        </p>
        <p class="card-text">
          {{ relatedWrittenArticle.blog_article_short_description }}
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
      displayRelatedWrittenArticles: null
    }
  },
  mounted () {
    this.getRelatedWrittenArticles()
  },
  methods: {
    getRelatedWrittenArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/related/written-articles'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + '/' + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          this.displayRelatedWrittenArticles = response.data.records[0]
        })
        .catch(error => {
          console.log(error.response)
        })
    }
  }
}
</script>
