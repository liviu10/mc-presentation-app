<template>
  <div class="lv-pg-audio">
    <div class="lv-pg-audio-title">
      <h1>{{ capitalizePageTitle }}</h1>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION START -->
    <div v-if="!displayAllAudioBlogArticles" class="lv-pg-audio-list">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-for="blogContent in displayAllAudioBlogArticles" v-else
         :key="blogContent.id"
         class="lv-pg-audio-list"
    >
      <div v-for="audioArticle in blogContent.blog_articles" :key="audioArticle.id">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              <a :href="audioArticle.blog_article_slug + '/' + audioArticle.id">
                {{ audioArticle.blog_article_title }}
              </a>
              <span v-if="audioArticle.blog_article_time <= 1">
                ({{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.less_than_one_minute') }})
              </span>
              <span v-else>
                ({{ audioArticle.blog_article_time }} {{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.more_than_one_minute') }})
              </span>
              <p v-if="audioArticle.updated_at == audioArticle.created_at">
                {{ $t('user.blog_system_pages.general_settings.published_on') }}
                <span>{{ new Date(audioArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
              <p v-else-if="audioArticle.updated_at > audioArticle.created_at">
                {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                <span>{{ new Date(audioArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
            </h5>
            <p class="card-text">
              <fa icon="quote-left" fixed-width />
              {{ audioArticle.blog_article_short_description }}
            </p>
            <!-- AUDIO PLAYER, SECTION START -->
            <aplayer :music="{
                       shuffle: false,
                       repeat: 'no-repeat',
                       title: 'Song Title',
                       artist: ' — ' + 'Song Artist',
                       src: '/audio/demo_file.mp3',
                       pic: '/images/blog/audio-player-img.jpg',
                     }"
                     :audio="{
                       autoplay: false,
                       controls: true,
                       preload: 'none',
                       volume: 1
                     }"
            />
          <!-- AUDIO PLAYER, SECTION END -->
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION END -->

    <!-- MORE AUDIO ARTICLES, SECTION START -->
    <div v-if="!displayAllAudioBlogArticles || (displayAllAudioBlogArticles.length >= 1 && displayAllAudioBlogArticles.length <= 3) " />
    <div v-else class="lv-pg-articles-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'audio' }) }}!
      </button>
    </div>
    <!-- MORE AUDIO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Aplayer from 'vue-aplayer'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'AudioListArticles',
  components: {
    Aplayer
  },
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllAudioBlogArticles: null
    }
  },
  computed: {
    capitalizePageTitle () {
      const pageTitle = this.$t('user.blog_system_pages.audio_article_blog_pages.page_title')
      return pageTitle.toUpperCase()
    }
  },
  mounted () {
    this.getAllAudioBlogArticles()
  },
  methods: {
    getAllAudioBlogArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/all-audio-articles'
      const fullApiUrl = url + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> List of audio blog articles <<<<<<')
          this.displayAllAudioBlogArticles = response.data
        })
    }
  }
}
</script>
