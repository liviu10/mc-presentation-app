<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <video-list-articles />
    </div>
  </div>
</template>

<script>
import VideoListArticles from '~/pages/user/blog/partials/VideoListArticles.vue'

export default {
  name: 'VideoArticle',
  components: {
    VideoListArticles
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.page_title') }
  }
}
</script>
