<template>
  <div class="container lv-con-pg-video">
    <div class="lv-con-pg-video-title">
      <h1>{{ capitalizePageTitle }}</h1>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION START -->
    <div v-if="!displayAllVideoBlogArticles" class="lv-con-pg-video-list">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-for="blogContent in displayAllVideoBlogArticles" v-else
         :key="blogContent.id"
         class="lv-con-pg-video-list"
    >
      <div v-for="videoArticle in blogContent.blog_articles" :key="videoArticle.id">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4">
              <!-- VIDEO PLAYER, SECTION START -->
              <video controls>
                <source src="/videos/demo_video.mp4" type="video/mp4">
              </video>
              <!-- VIDEO PLAYER, SECTION END -->
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  <a :href="videoArticle.blog_article_slug + '/' + videoArticle.id">
                    {{ videoArticle.blog_article_title }}
                  </a>
                  <span v-if="videoArticle.blog_article_time <= 1">
                    ({{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.less_than_one_minute') }})
                  </span>
                  <span v-else>
                    ({{ videoArticle.blog_article_time }} {{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.more_than_one_minute') }})
                  </span>
                  <p v-if="videoArticle.updated_at == videoArticle.created_at">
                    {{ $t('user.blog_system_pages.general_settings.published_on') }}
                    <span>{{ new Date(videoArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                  </p>
                  <p v-else-if="videoArticle.updated_at > videoArticle.created_at">
                    {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                    <span>{{ new Date(videoArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                  </p>
                </h5>
                <p class="card-text">
                  <fa icon="quote-left" fixed-width />
                  {{ videoArticle.blog_article_short_description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION END -->

    <!-- MORE VIDEO ARTICLES, SECTION START -->
    <div v-if="!displayAllVideoBlogArticles || (displayAllVideoBlogArticles.length >= 1 && displayAllVideoBlogArticles.length <= 3) " />
    <div v-else class="lv-con-pg-articles-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'video' }) }}!
      </button>
    </div>
    <!-- MORE VIDEO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'VideoListArticles',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllVideoBlogArticles: null
    }
  },
  computed: {
    capitalizePageTitle () {
      const pageTitle = this.$t('user.blog_system_pages.video_article_blog_pages.page_title')
      return pageTitle.toUpperCase()
    }
  },
  mounted () {
    this.getAllVideoBlogArticles()
  },
  methods: {
    getAllVideoBlogArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/all-video-articles'
      const fullApiUrl = url + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> List of video blog articles <<<<<<')
          this.displayAllVideoBlogArticles = response.data
        })
    }
  }
}
</script>
