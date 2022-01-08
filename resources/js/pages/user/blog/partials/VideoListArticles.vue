<template>
  <div class="lv-pg-video">
    <div class="lv-pg-video-header">
      <h1>{{ $t('user.blog_system_pages.video_article_blog_pages.page_title') }}</h1>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION START -->
    <div v-if="!displayAllVideoBlogArticles" class="lv-pg-video-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="blogContent in displayAllVideoBlogArticles"
           :key="blogContent.id"
           class="lv-pg-video-body"
      >
        <div v-for="videoArticle in blogContent.blog_articles" :key="videoArticle.id" class="my-3">
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
                  <h3 class="card-title">
                    <a :href="videoArticle.blog_article_path + '/' + videoArticle.id">
                      <span>{{ videoArticle.blog_article_title }}</span>
                    </a>
                    <span v-if="videoArticle.blog_article_time <= 1">
                      ({{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.less_than_one_minute') }})
                    </span>
                    <span v-else>
                      ({{ videoArticle.blog_article_time }} {{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.more_than_one_minute') }})
                    </span>
                    <p>
                      {{ $t('user.blog_system_pages.subcategory_name') }}
                      <span>
                        <a :href="blogContent.blog_subcategory_path">{{ blogContent.blog_subcategory_title }}</a>
                      </span>
                    </p>
                    <p v-if="videoArticle.updated_at == videoArticle.created_at">
                      {{ $t('user.blog_system_pages.general_settings.published_on') }}
                      <span>{{ new Date(videoArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                    </p>
                    <p v-else>
                      {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                      <span>{{ new Date(videoArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                    </p>
                  </h3>
                  <p class="card-text">
                    <fa icon="quote-left" fixed-width />
                    {{ videoArticle.blog_article_short_description }}
                  </p>
                </div>
                <div class="card-body">
                  <a :href="videoArticle.blog_article_path + '/' + videoArticle.id" class="btn btn-primary">
                    <fa icon="eye" fixed-width />
                    {{ $t('user.blog_system_pages.video_article_blog_pages.read_more') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION END -->
    <!-- MORE VIDEO ARTICLES, SECTION START -->
    <!-- TODO: Paginate the articles -->
    <!-- <div class="lv-pg-articles-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'articole video' }) }}!
      </button>
    </div> -->
    <!-- MORE VIDEO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'VideoListArticles',
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null
    }
  },
  computed: {
    ...mapGetters({
      listOfVideoArticles: 'blog/listOfVideoArticles'
    }),
    displayAllVideoBlogArticles () {
      return this.listOfVideoArticles.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.listOfVideoArticles.http_response_code
    }
  },
  created () {
    this.fetchListOfVideoArticles()
  },
  methods: {
    ...mapActions({
      fetchListOfVideoArticles: 'blog/fetchListOfVideoArticles'
    })
  }
}
</script>
