<template>
  <div v-if="displayRelatedAudioArticles" class="article-related">
    <h1>{{ $t('user.blog_system_pages.general_settings.related_articles.title') }}</h1>
    <div v-for="relatedAudioArticle in displayRelatedAudioArticles.blog_articles" :key="relatedAudioArticle.id" class="card">
      <div class="card-body">
        <img src="/images/blog/audio-player-img.jpg" class="card-img-top" :alt="relatedAudioArticle.blog_article_title">
      </div>
      <div class="card-body">
        <p class="card-text">
          <a :href="relatedAudioArticle.blog_article_path + '/' + relatedAudioArticle.id">
            {{ relatedAudioArticle.blog_article_title }}
          </a>
        </p>
        <p class="card-text">
          {{ relatedAudioArticle.blog_article_short_description }}
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
      displayRelatedAudioArticles: null
    }
  },
  mounted () {
    this.getRelatedAudioArticles()
  },
  methods: {
    getRelatedAudioArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/related/audio-articles'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + '/' + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a list of related audio blog articles: ')
          this.displayRelatedAudioArticles = response.data.records[0]
        })
        .catch(({ response }) => {
          console.log('>>>>>> Http request error: ')
        })
    }
  }
}
</script>
