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
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {}
  },
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {
    showMore () {
      this.$router.push({ path: '/blog/video' })
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.meta_title') }
  }
}
</script>
