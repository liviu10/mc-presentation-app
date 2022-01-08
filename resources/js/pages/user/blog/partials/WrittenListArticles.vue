<template>
  <div class="lv-pg-articles">
    <div class="lv-pg-articles-header">
      <h1>{{ $t('user.blog_system_pages.written_article_blog_pages.page_title') }}</h1>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION START -->
    <div v-if="!displayAllWrittenBlogArticles" class="lv-pg-articles-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="blogContent in displayAllWrittenBlogArticles"
           :key="blogContent.id"
           class="lv-pg-articles-body"
      >
        <div v-for="writtenArticle in blogContent.blog_articles" :key="writtenArticle.id" class="my-3">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">
                <a :href="writtenArticle.blog_article_path + '/' + writtenArticle.id">
                  <span>{{ writtenArticle.blog_article_title }}</span>
                </a>
                <span v-if="writtenArticle.blog_article_time <= 1">
                  ({{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.less_than_one_minute') }})
                </span>
                <span v-else>
                  ({{ writtenArticle.blog_article_time }} {{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.more_than_one_minute') }})
                </span>
                <p>
                  {{ $t('user.blog_system_pages.subcategory_name') }}
                  <span>
                    <a :href="blogContent.blog_subcategory_path">{{ blogContent.blog_subcategory_title }}</a>
                  </span>
                </p>
                <p v-if="writtenArticle.updated_at == writtenArticle.created_at">
                  {{ $t('user.blog_system_pages.general_settings.published_on') }}
                  <span>{{ new Date(writtenArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                </p>
                <p v-else>
                  {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                  <span>{{ new Date(writtenArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                </p>
              </h3>
              <p class="card-text">
                <fa icon="quote-left" fixed-width />
                {{ writtenArticle.blog_article_short_description }}
              </p>
            </div>
            <div class="card-body">
              <a :href="writtenArticle.blog_article_path + '/' + writtenArticle.id" class="btn btn-primary">
                <fa icon="book-reader" fixed-width />
                {{ $t('user.blog_system_pages.written_article_blog_pages.read_more') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION END -->
    <!-- MORE WRITTEN ARTICLES, SECTION START -->
    <!-- TODO: Paginate the articles -->
    <!-- <div class="lv-pg-articles-button-more">
      <button type="button" class="btn btn-primary btn-lg">
        <i class="far fa-clock" />
        {{ $t('user.blog_system_pages.general_settings.more_articles', { type: 'articole' }) }}!
      </button>
    </div> -->
    <!-- MORE WRITTEN ARTICLES, SECTION END -->
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
  name: 'WrittenListArticles',
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null
    }
  },
  computed: {
    ...mapGetters({
      listOfWrittenArticles: 'blog/listOfWrittenArticles'
    }),
    displayAllWrittenBlogArticles () {
      return this.listOfWrittenArticles.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.listOfWrittenArticles.http_response_code
    }
  },
  created () {
    this.fetchListOfWrittenArticles()
  },
  methods: {
    ...mapActions({
      fetchListOfWrittenArticles: 'blog/fetchListOfWrittenArticles'
    })
  }
}
</script>
