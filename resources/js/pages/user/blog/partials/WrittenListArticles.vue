<template>
  <div class="container lv-con-pg-articles">
    <div class="lv-con-pg-articles-title">
      <h1>{{ capitalizePageTitle }}</h1>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION START -->
    <div v-if="!displayAllWrittenBlogArticles" class="lv-con-pg-articles-list">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-for="writtenArticle in displayAllWrittenBlogArticles" v-else
         :key="writtenArticle.id"
         class="lv-con-pg-articles-list"
    >
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            <a :href="writtenArticle.blog_article_slug + '/' + writtenArticle.id">
              {{ writtenArticle.blog_article_title }}
            </a>
            <span v-if="writtenArticle.blog_article_reading_time <= 1">
              ({{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.less_than_one_minute') }})
            </span>
            <span v-else>
              ({{ writtenArticle.blog_article_reading_time }} {{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.more_than_one_minute') }})
            </span>
            <p v-if="writtenArticle.updated_at == writtenArticle.created_at">
              {{ $t('user.blog_system_pages.general_settings.published_on') }}
              <span>{{ new Date(writtenArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
            </p>
            <p v-else-if="writtenArticle.updated_at > writtenArticle.created_at">
              {{ $t('user.blog_system_pages.general_settings.modified_on') }}
              <span>{{ new Date(writtenArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
            </p>
          </h5>
          <p class="card-text">
            <fa icon="quote-left" fixed-width />
            {{ writtenArticle.blog_article_short_description }}
          </p>
          <a :href="writtenArticle.blog_article_slug + '/' + writtenArticle.id" class="btn btn-primary">
            <fa icon="book-reader" fixed-width />
            {{ $t('user.blog_system_pages.written_article_blog_pages.read_more') }}
          </a>
        </div>
      </div>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION END -->
    <!-- MORE WRITTEN ARTICLES, SECTION START -->
    <div v-if="!displayAllWrittenBlogArticles || (displayAllWrittenBlogArticles.length >= 1 && displayAllWrittenBlogArticles.length <= 3) " />
    <div v-else class="lv-con-pg-articles-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'articole' }) }}!
      </button>
    </div>
    <!-- MORE WRITTEN ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'WrittenListArticles',
  components: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllWrittenBlogArticles: null
    }
  },
  computed: {
    capitalizePageTitle () {
      const pageTitle = this.$t('user.blog_system_pages.written_article_blog_pages.page_title')
      return pageTitle.toUpperCase()
    }
  },
  mounted () {
    this.getAllWrittenBlogArticles()
  },
  methods: {
    getAllWrittenBlogArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog-configuration/articles/all-written-articles'
      const fullApiUrl = url + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> List of written blog articles <<<<<<')
          if (response.data.results.length === 0) {
            this.notifyCode = response.data.notify_code
            this.notifyMessage = response.data.user_message
          } else {
            this.displayAllWrittenBlogArticles = response.data.results
          }
        })
    }
  }
}
</script>
