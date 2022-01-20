<template>
  <div>
    <!-- RATE THIS, SECTION START -->
    <div class="video-article-rate">
      <p>
        {{ $t('user.blog_system_pages.general_settings.rating_system.title') }}
        <rate v-model="myRate"
              :length="5"
              :value="0"
              :showcount="true"
              :ratedesc="[
                $t('user.blog_system_pages.general_settings.rating_system.options.very_bad'),
                $t('user.blog_system_pages.general_settings.rating_system.options.bad'),
                $t('user.blog_system_pages.general_settings.rating_system.options.normal'),
                $t('user.blog_system_pages.general_settings.rating_system.options.good'),
                $t('user.blog_system_pages.general_settings.rating_system.options.very_good')
              ]"
        />
      </p>
    </div>
    <!-- RATE THIS, SECTION END -->
    <!-- ARTICLE SUBCATEGORY, SECTION START -->
    <div class="video-article-subcategory">
      <p>
        {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.article_subcategory') }}:
        &nbsp;
        <a :href="blogArticleSubcategoryPath">{{ blogArticleSubcategoryTitle }}</a>
      </p>
    </div>
    <!-- ARTICLE SUBCATEGORY, SECTION END -->
    <!-- SHARE THIS, SECTION START -->
    <div class="video-article-share">
      <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.like')"
         @click="likeTheArticle()"
      >
        <fa :icon="['fa', 'thumbs-up']" fixed-width /> {{ blogArticleLikes }} {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.like_dislike_system.like') }}
      </a>
      <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.dislike')"
         @click="dislikeTheArticle()"
      >
        <fa :icon="['fa', 'thumbs-down']" fixed-width /> {{ blogArticleDislikes }} {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.like_dislike_system.dislike') }}
      </a>
      <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.facebook')">
        <fa :icon="['fab', 'facebook']" fixed-width />
      </a>
      <!-- <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.instagram')">
        <fa :icon="['fab', 'instagram']" fixed-width />
      </a>
      <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.email')">
        <fa :icon="['fa', 'envelope']" fixed-width />
      </a> -->
    </div>
    <!-- SHARE THIS, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import rate from 'vue-rate'
import 'vue-rate/dist/vue-rate.css'

Vue.use(rate)

export default {
  name: 'OptionDetails',
  props: {
    blogArticleRating: {
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
      type: Number
    },
    blogArticleDislikes: {
      default: null,
      type: Number
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
      myRate: 0
    }
  }
}
</script>
