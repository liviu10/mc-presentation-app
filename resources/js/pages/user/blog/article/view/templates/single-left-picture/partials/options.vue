<template>
  <div>
    <!-- ARTICLE SUBCATEGORY, SECTION START -->
    <div class="article-subcategory">
      <p>
        {{ $t('user.blog_system_pages.general_settings.subcategory_name') }}
        &nbsp;
        <a :href="blogArticleSubcategoryPath">{{ blogArticleSubcategoryTitle }}</a>
      </p>
    </div>
    <!-- ARTICLE SUBCATEGORY, SECTION END -->
    <!-- APPRECIATION, SECTION START -->
    <div class="article-appreciation">
      <p>
        {{ $t('user.blog_system_pages.general_settings.appreciation_menu.label') }}
        &nbsp;
        <a target="_blank"
           :title="$t('user.blog_system_pages.general_settings.appreciation_menu.like')"
           @click="likeTheArticle()"
        >
          <fa :icon="['fa', 'thumbs-up']" fixed-width />&nbsp;<span v-if="blogArticleLikes.length !== 0">{{ blogArticleLikes.length }}</span>
        </a>
        <a target="_blank"
           :title="$t('user.blog_system_pages.general_settings.appreciation_menu.dislike')"
           @click="dislikeTheArticle()"
        >
          <fa :icon="['fa', 'thumbs-down']" fixed-width />&nbsp;<span v-if="blogArticleDislikes.length !== 0">{{ blogArticleDislikes.length }}</span>
        </a>
      </p>
    </div>
    <!-- APPRECIATION, SECTION END -->
    <!-- RATE THIS, SECTION START -->
    <div class="article-rate">
      <p>
        {{ $t('user.blog_system_pages.general_settings.appreciation_menu.rate') }}
        <rate v-model="rate_article"
              :length="5"
              :value="0"
              :showcount="true"
              :ratedesc="[
                $t('user.blog_system_pages.general_settings.appreciation_menu.rating_system.options.very_bad'),
                $t('user.blog_system_pages.general_settings.appreciation_menu.rating_system.options.bad'),
                $t('user.blog_system_pages.general_settings.appreciation_menu.rating_system.options.normal'),
                $t('user.blog_system_pages.general_settings.appreciation_menu.rating_system.options.good'),
                $t('user.blog_system_pages.general_settings.appreciation_menu.rating_system.options.very_good')
              ]"
              @after-rate="rateTheArticle()"
        />
        <span v-if="blogArticleRating && blogArticleRating.length === 0">(nici o evaluare)</span>
        <span v-else-if="blogArticleRating && blogArticleRating.length === 1">({{ blogArticleRating.length }} evaluare)</span>
        <span v-else>({{ blogArticleRating.length }} evaluari)</span>
      </p>
    </div>
    <!-- RATE THIS, SECTION END -->
    <!-- SHARE & APPRECIATION, SECTION START -->
    <div class="article-share">
      <p>
        {{ $t('user.blog_system_pages.general_settings.appreciation_menu.title') }}:
        &nbsp;
        <a href="" target="_blank" :title="$t('user.blog_system_pages.general_settings.appreciation_menu.facebook')">
          <fa :icon="['fab', 'facebook']" fixed-width />
        </a>
      </p>
    </div>
    <!-- SHARE & APPRECIATION, SECTION END -->
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import Vue from 'vue'
import rate from 'vue-rate'
import 'vue-rate/dist/vue-rate.css'

Vue.use(rate)

export default {
  name: 'OptionDetails',
  props: {
    blogArticleId: {
      default: null,
      type: Number
    },
    blogArticleRating: {
      default: null,
      type: Array
    },
    blogArticleAverageRating: {
      default: null,
      type: Number
    },
    blogArticleSubcategoryTitle: {
      default: null,
      type: String
    },
    blogArticleSubcategoryPath: {
      default: null,
      type: String
    },
    blogArticleLikes: {
      default: null,
      type: Array
    },
    blogArticleDislikes: {
      default: null,
      type: Array
    },
    length: {
      type: Number,
      default: null
    },
    value: {
      type: Number,
      default: null
    },
    showcount: {
      type: Boolean,
      default: null
    },
    ratedesc: {
      type: String,
      default: null
    }
  },
  data: function () {
    return {
      rate_article: this.blogArticleAverageRating
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async rateTheArticle () {
      const rateArticleScore = this.rate_article
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.message'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            this.rate_article = 0
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/blog/appreciate/rate-article'
        const apiDeleteEndPoint = '/api/blog/appreciate/remove-rate-article'
        const fullApiUrl = url + apiEndPoint
        const fullApiDeleteUrl = url + apiDeleteEndPoint
        const userName = this.user.name
        try {
          await axios.post(fullApiUrl, {
            user_id: this.user.id,
            blog_article_id: this.blogArticleId,
            blog_article_rating_system: rateArticleScore
          })
            .then(response => {
              Swal.fire({
                title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
                text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.message')
              }).then((result) => {
                this.rate_article = response.data
                window.location.reload()
              })
            })
        } catch (error) {
          if (error.response.status === 406) {
            Swal.fire({
              title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
              text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.already_message'),
              showDenyButton: true,
              denyButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.deny_like')
            }).then((result) => {
              if (result.isDenied) {
                axios.delete(fullApiDeleteUrl, {
                  data: {
                    user_id: this.user.id,
                    blog_article_id: this.blogArticleId
                  }
                }).then((result) => {
                  window.location.reload()
                })
              }
            })
          }
        }
      }
    },
    async likeTheArticle () {
      let likeArticle = 0
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.message'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            likeArticle = 0
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/blog/appreciate/like-article'
        const apiDeleteEndPoint = '/api/blog/appreciate/remove-like-article'
        const fullApiUrl = url + apiEndPoint
        const fullApiDeleteUrl = url + apiDeleteEndPoint
        const userName = this.user.name
        try {
          await axios.post(fullApiUrl, {
            user_id: this.user.id,
            blog_article_id: this.blogArticleId,
            blog_article_likes: likeArticle + 1
          })
            .then(response => {
              Swal.fire({
                title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
                text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.message')
              }).then((result) => {
                likeArticle = 0
                window.location.reload()
              })
            })
        } catch (error) {
          if (error.response.status === 406) {
            Swal.fire({
              title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
              text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.already_message'),
              showDenyButton: true,
              denyButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.deny_like')
            }).then((result) => {
              if (result.isDenied) {
                axios.delete(fullApiDeleteUrl, {
                  data: {
                    user_id: this.user.id,
                    blog_article_id: this.blogArticleId
                  }
                }).then((result) => {
                  window.location.reload()
                })
              }
            })
          }
        }
      }
    },
    async dislikeTheArticle () {
      let dislikeArticle = 0
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.message'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            dislikeArticle = 0
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/blog/appreciate/dislike-article'
        const apiDeleteEndPoint = '/api/blog/appreciate/remove-dislike-article'
        const fullApiUrl = url + apiEndPoint
        const fullApiDeleteUrl = url + apiDeleteEndPoint
        const userName = this.user.name
        try {
          await axios.post(fullApiUrl, {
            user_id: this.user.id,
            blog_article_id: this.blogArticleId,
            blog_article_dislikes: dislikeArticle + 1
          })
            .then(response => {
              Swal.fire({
                title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
                text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.message')
              }).then((result) => {
                dislikeArticle = 0
                window.location.reload()
              })
            })
        } catch (error) {
          if (error.response.status === 406) {
            Swal.fire({
              title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
              text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.already_message'),
              showDenyButton: true,
              denyButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.deny_like')
            }).then((result) => {
              if (result.isDenied) {
                axios.delete(fullApiDeleteUrl, {
                  data: {
                    user_id: this.user.id,
                    blog_article_id: this.blogArticleId
                  }
                }).then((result) => {
                  window.location.reload()
                })
              }
            })
          }
        }
      }
    }
  }
}
</script>
