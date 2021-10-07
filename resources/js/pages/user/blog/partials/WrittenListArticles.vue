<template>
  <div class="container lv-con-pg-articles">
    <div class="lv-con-pg-articles-title">
      <h1>{{ capitalizePageTitle }}</h1>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION START -->
    <div v-for="writtenArticle in displayAllWrittenBlogArticles"
         :key="writtenArticle.id"
         class="lv-con-pg-articles-list"
    >
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            {{ writtenArticle.blog_article_title }}
            <span v-if="writtenArticle.blog_article_reading_time <= 1">
              ({{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.less_than_one_minute') }})
            </span>
            <span v-else>
              ({{ writtenArticle.blog_article_reading_time }} {{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.more_than_one_minute') }})
            </span>
            <p>
              {{ $t('user.blog_system_pages.general_settings.published_on') }}
              <span>{{ writtenArticle.created_at }}</span>
            </p>
          </h5>
          <p class="card-text">
            <fa icon="quote-left" fixed-width />
            {{ writtenArticle.blog_article_short_description }}
          </p>
          <router-link :to="{ name: 'article-view-index' }"
                       class="btn btn-primary"
          >
            <fa icon="book-reader" fixed-width />
            {{ $t('user.blog_system_pages.written_article_blog_pages.read_more') }}
          </router-link>
        </div>
      </div>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION END -->
    <!-- MORE WRITTEN ARTICLES, SECTION START -->
    <div class="lv-con-pg-articles-button-more">
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
      const allWrittenBlogArticlesApi = url + '/api/blog-configuration/articles/all-written-articles'
      axios
        .get(allWrittenBlogArticlesApi)
        .then(response => {
          console.log('>>>>> Written Blog Articles Api Data', response.data)
          this.displayAllWrittenBlogArticles = response.data.results
        })
    }
  }
}
</script>
