<template>
  <div class="lv-pg-subcategories-audio">
    <div class="lv-pg-subcategories-audio-header">
      <h1>{{ blogSubcategoryTitle }}</h1>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION START -->
    <div v-if="!displayAllBlogSubcategoryAudioArticles" class="lv-pg-subcategories-audio-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="subcategoryAudioArticle in displayAllBlogSubcategoryAudioArticles.blog_articles"
           :key="subcategoryAudioArticle.id"
           class="my-3 lv-pg-subcategories-audio-body"
      >
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">
              <a :href="subcategoryAudioArticle.blog_article_path + '/' + subcategoryAudioArticle.id">
                <span>{{ subcategoryAudioArticle.blog_article_title }}</span>
              </a>
              <span v-if="subcategoryAudioArticle.blog_article_time <= 1">
                ({{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.less_than_one_minute') }})
              </span>
              <span v-else>
                ({{ subcategoryAudioArticle.blog_article_time }} {{ $t('user.blog_system_pages.audio_article_blog_pages.listening_time.more_than_one_minute') }})
              </span>
              <p>
                {{ $t('user.blog_system_pages.subcategory_name') }}
                <span>
                  <a :href="blogSubcategoryPath">{{ blogSubcategoryTitle }}</a>
                </span>
              </p>
              <p v-if="subcategoryAudioArticle.updated_at == subcategoryAudioArticle.created_at">
                {{ $t('user.blog_system_pages.general_settings.published_on') }}
                <span>{{ new Date(subcategoryAudioArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
              <p v-else>
                {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                <span>{{ new Date(subcategoryAudioArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
            </h3>
            <p class="card-text">
              <fa icon="quote-left" fixed-width />
              {{ subcategoryAudioArticle.blog_article_short_description }}
            </p>
            <!-- AUDIO PLAYER, SECTION START -->
            <aplayer :music="{
                       shuffle: false,
                       repeat: 'no-repeat',
                       title: 'Song Title',
                       artist: ' — ' + 'Song Artist',
                       src: '/audio/demo_file.mp3',
                       pic: '/images/pages/blog/audio_player/audio-player-img_100.webp',
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
            <a :href="subcategoryAudioArticle.blog_article_path + '/' + subcategoryAudioArticle.id" class="btn btn-primary">
              <fa icon="headphones" fixed-width />
              {{ $t('user.blog_system_pages.audio_article_blog_pages.read_more') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION END -->
    <!-- MORE AUDIO ARTICLES, SECTION START -->
    <!-- TODO Blog System: Paginate the articles -->
    <!-- <div class="lv-pg-subcategories-audio-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'articole audio' }) }}!
      </button>
    </div> -->
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
  name: 'BlogSubcategoryAudioArticles',
  components: {
    Aplayer
  },
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryAudioArticles: null,
      blogSubcategoryTitle: '',
      blogSubcategoryPath: ''
    }
  },
  mounted () {
    this.getAllBlogSubcategoryAudioArticles()
  },
  methods: {
    getAllBlogSubcategoryAudioArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/subcategory/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-audio-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          this.displayAllBlogSubcategoryAudioArticles = response.data.records[0]
          this.blogSubcategoryTitle = response.data.records[0].blog_subcategory_title
          this.blogSubcategoryPath = response.data.records[0].blog_subcategory_path
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.audio_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
