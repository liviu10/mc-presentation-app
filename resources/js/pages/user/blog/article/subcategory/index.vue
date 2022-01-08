<template>
  <div class="lv-pg-subcategories-articles">
    <div class="lv-pg-subcategories-articles-header">
      <h1>{{ blogSubcategoryTitle }}</h1>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION START -->
    <div v-if="!displayAllBlogSubcategoryWrittenArticles" class="lv-pg-subcategories-articles-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="subcategoryWrittenArticle in displayAllBlogSubcategoryWrittenArticles.blog_articles"
           :key="subcategoryWrittenArticle.id"
           class="my-3 lv-pg-subcategories-articles-body"
      >
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">
              <a :href="subcategoryWrittenArticle.blog_article_path + '/' + subcategoryWrittenArticle.id">
                <span>{{ subcategoryWrittenArticle.blog_article_title }}</span>
              </a>
              <span v-if="subcategoryWrittenArticle.blog_article_time <= 1">
                ({{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.less_than_one_minute') }})
              </span>
              <span v-else>
                ({{ subcategoryWrittenArticle.blog_article_time }} {{ $t('user.blog_system_pages.written_article_blog_pages.reading_time.more_than_one_minute') }})
              </span>
              <p>
                {{ $t('user.blog_system_pages.subcategory_name') }}
                <span>
                  <a :href="blogSubcategoryPath">{{ blogSubcategoryTitle }}</a>
                </span>
              </p>
              <p v-if="subcategoryWrittenArticle.updated_at == subcategoryWrittenArticle.created_at">
                {{ $t('user.blog_system_pages.general_settings.published_on') }}
                <span>{{ new Date(subcategoryWrittenArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
              <p v-else>
                {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                <span>{{ new Date(subcategoryWrittenArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </p>
            </h3>
            <p class="card-text">
              <fa icon="quote-left" fixed-width />
              {{ subcategoryWrittenArticle.blog_article_short_description }}
            </p>
          </div>
          <div class="card-body">
            <a :href="subcategoryWrittenArticle.blog_article_path + '/' + subcategoryWrittenArticle.id" class="btn btn-primary">
              <fa icon="book-reader" fixed-width />
              {{ $t('user.blog_system_pages.written_article_blog_pages.read_more') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF WRITTEN ARTICLES, SECTION END -->
    <!-- MORE WRITTEN ARTICLES, SECTION START -->
    <!-- TODO: Paginate the articles -->
    <!-- <div class="lv-pg-subcategories-articles-button-more">
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
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'BlogSubcategoryWrittenArticles',
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryWrittenArticles: null,
      blogSubcategoryTitle: '',
      blogSubcategoryPath: ''
    }
  },
  mounted () {
    this.getAllBlogSubcategoryWrittenArticles()
  },
  methods: {
    getAllBlogSubcategoryWrittenArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/subcategory/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-written-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> List of written blog articles for a given blog subcategory: ', response.data.records[0])
          this.displayAllBlogSubcategoryWrittenArticles = response.data.records[0]
          this.blogSubcategoryTitle = response.data.records[0].blog_subcategory_title
          this.blogSubcategoryPath = response.data.records[0].blog_subcategory_path
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
