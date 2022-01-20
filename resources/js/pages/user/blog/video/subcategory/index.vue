<template>
  <div class="lv-pg-subcategories-video">
    <div class="lv-pg-subcategories-video-header">
      <h1>{{ blogSubcategoryTitle }}</h1>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION START -->
    <div v-if="!displayAllBlogSubcategoryVideoArticles" class="lv-pg-subcategories-video-body">
      <h1>{{ notifyMessage }}</h1>
    </div>
    <div v-else>
      <div v-for="subcategoryVideoArticle in displayAllBlogSubcategoryVideoArticles.blog_articles"
           :key="subcategoryVideoArticle.id"
           class="my-3 lv-pg-subcategories-video-body"
      >
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
                  <a :href="subcategoryVideoArticle.blog_article_path + '/' + subcategoryVideoArticle.id">
                    <span>{{ subcategoryVideoArticle.blog_article_title }}</span>
                  </a>
                  <span v-if="subcategoryVideoArticle.blog_article_time <= 1">
                    ({{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.less_than_one_minute') }})
                  </span>
                  <span v-else>
                    ({{ subcategoryVideoArticle.blog_article_time }} {{ $t('user.blog_system_pages.video_article_blog_pages.listening_time.more_than_one_minute') }})
                  </span>
                  <p>
                    {{ $t('user.blog_system_pages.subcategory_name') }}
                    <span>
                      <a :href="blogSubcategoryPath">{{ blogSubcategoryTitle }}</a>
                    </span>
                  </p>
                  <p v-if="subcategoryVideoArticle.updated_at == subcategoryVideoArticle.created_at">
                    {{ $t('user.blog_system_pages.general_settings.published_on') }}
                    <span>{{ new Date(subcategoryVideoArticle.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                  </p>
                  <p v-else>
                    {{ $t('user.blog_system_pages.general_settings.modified_on') }}
                    <span>{{ new Date(subcategoryVideoArticle.updated_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                  </p>
                </h3>
                <p class="card-text">
                  <fa icon="quote-left" fixed-width />
                  {{ subcategoryVideoArticle.blog_article_short_description }}
                </p>
              </div>
              <div class="card-body">
                <a :href="subcategoryVideoArticle.blog_article_path + '/' + subcategoryVideoArticle.id" class="btn btn-primary">
                  <fa icon="eye" fixed-width />
                  {{ $t('user.blog_system_pages.video_article_blog_pages.read_more') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION END -->
    <!-- MORE VIDEO ARTICLES, SECTION START -->
    <!-- TODO Blog System: Paginate the articles -->
    <!-- <div class="lv-pg-subcategories-video-button-more">
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
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'BlogSubcategoryVideoArticles',
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      displayAllBlogSubcategoryVideoArticles: null,
      blogSubcategoryTitle: '',
      blogSubcategoryPath: ''
    }
  },
  mounted () {
    this.getAllBlogSubcategoryVideoArticles()
  },
  methods: {
    getAllBlogSubcategoryVideoArticles: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/subcategory/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter + '/all-video-articles'
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> List of video blog articles for a given blog subcategory: ')
          this.displayAllBlogSubcategoryVideoArticles = response.data.records[0]
          this.blogSubcategoryTitle = response.data.records[0].blog_subcategory_title
          this.blogSubcategoryPath = response.data.records[0].blog_subcategory_path
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
