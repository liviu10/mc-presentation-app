<template>
  <div class="lv-pg-audio">
    <div class="lv-pg-audio-header">
      <h1>{{ $t('user.blog_system_pages.audio_article_blog_pages.page_title') }}</h1>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION START -->
    <div v-if="!displayAllAudioBlogArticles" class="lv-pg-audio-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="blogContent in displayAllAudioBlogArticles"
           :key="blogContent.id"
           class="lv-pg-audio-body"
      >
        <div v-for="audioArticle in blogContent.blog_articles" :key="audioArticle.id" class="my-3">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">
                <a :href="audioArticle.blog_article_slug + '/' + audioArticle.id">
                  <span>{{ audioArticle.blog_article_title }}</span>
                </a>
                <span v-if="audioArticle.blog_article_time <= 1">
                  ({{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.less_than_one_minute') }})
                </span>
                <span v-else>
                  ({{ audioArticle.blog_article_time }} {{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.more_than_one_minute') }})
                </span>
                <p>
                  {{ $t('user.blog_system_pages.subcategory_name') }}
                  <span>
                    <a :href="blogContent.blog_subcategory_path">{{ blogContent.blog_subcategory_title }}</a>
                  </span>
                </p>
                <p v-if="audioArticle.updated_at == audioArticle.created_at">
                  {{ $t('user.blog_system_pages.general_settings.published_on') }}
                  <span>{{ new Date(audioArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                </p>
                <p v-else>
                  {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                  <span>{{ new Date(audioArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                </p>
              </h3>
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
            <div class="card-body">
              <a :href="audioArticle.blog_article_path + '/' + audioArticle.id" class="btn btn-primary">
                <fa icon="eye" fixed-width />
                {{ $t('user.blog_system_pages.audio_article_blog_pages.read_more') }}
              </a>
            </div>
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
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'articole audio' }) }}!
      </button>
    </div>
    <!-- MORE AUDIO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Aplayer from 'vue-aplayer'
import Vuex, { mapGetters, mapActions } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AudioListArticles',
  components: {
    Aplayer
  },
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null
    }
  },
  computed: {
    ...mapGetters({
      listOfAudioArticles: 'blog/listOfAudioArticles'
    }),
    displayAllAudioBlogArticles () {
      return this.listOfAudioArticles.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.listOfAudioArticles.http_response_code
    }
  },
  created () {
    this.fetchListOfAudioArticles()
  },
  methods: {
    ...mapActions({
      fetchListOfAudioArticles: 'blog/fetchListOfAudioArticles'
    })
  }
}
</script>
