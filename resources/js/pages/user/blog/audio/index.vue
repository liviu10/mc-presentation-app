<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <audio-list-articles />
    </div>
  </div>
</template>

<script>
import AudioListArticles from '~/pages/user/blog/partials/AudioListArticles.vue'

export default {
  name: 'AudioArticlesPage',
  components: {
    AudioListArticles
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.audio_article_blog_pages.page_title') }
  }
}
</script>
