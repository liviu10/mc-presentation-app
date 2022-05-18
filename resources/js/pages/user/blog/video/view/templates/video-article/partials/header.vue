<template>
  <div class="video-article-header">
    <div class="video-article-header-img">
      <img src="/images/user/user-profile-img_30.webp" alt=""> &bullet;
    </div>
    <div class="video-article-header-author">
      <span>{{ blogArticleAuthor }} </span> &bullet;
    </div>
    <div class="video-article-header-publish-date">
      <span v-if="blogArticleUpdated == blogArticleCreated">
        {{ new Date(blogArticleCreated).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
      </span>
      <span v-else>
        {{ new Date(blogArticleUpdated).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
      </span> &bullet;
    </div>
    <div class="video-article-header-reading-time">
      <span v-if="blogArticleReadingTime <= 1">
        {{ $t('user.blog_system_pages.video_article_blog_pages.viewing_time.less_than_one_minute') }}
      </span>
      <span v-else>
        {{ blogArticleReadingTime }} {{ $t('user.blog_system_pages.video_article_blog_pages.viewing_time.more_than_one_minute') }}
      </span> &bullet;
    </div>
    <div v-if="blogArticleComments" class="video-article-header-no-comments">
      <span v-if="blogArticleComments === 1">
        <a href="#article_comments">
          {{ blogArticleComments }} {{ $t('user.blog_system_pages.general_settings.comment_section.no_of_comments.singular') }}
        </a>
      </span>
      <span v-if="blogArticleComments > 1">
        <a href="#article_comments">
          {{ blogArticleComments }} {{ $t('user.blog_system_pages.general_settings.comment_section.no_of_comments.plural') }}
        </a>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HeaderDetails',
  props: {
    blogArticleAuthor: {
      default: null,
      type: String
    },
    blogArticleCreated: {
      default: null,
      type: String
    },
    blogArticleUpdated: {
      default: null,
      type: String
    },
    blogArticleReadingTime: {
      default: null,
      type: Number
    },
    blogArticleComments: {
      default: null,
      type: Number
    }
  }
}
</script>
