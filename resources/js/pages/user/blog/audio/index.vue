<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-audio">
        <div class="lv-con-pg-audio-title">
          <h1>APP AUDIO ARTICLES PAGE</h1>
        </div>
        <!-- LIST OF AUDIO ARTICLES, SECTION START -->
        <audio-player-article-page />
        <!-- LIST OF AUDIO ARTICLES, SECTION END -->
        <!-- LIST OF AUDIO ARTICLES, SECTION START -->
        <audio-player-article-page />
        <!-- LIST OF AUDIO ARTICLES, SECTION END -->
        <!-- LIST OF AUDIO ARTICLES, SECTION START -->
        <audio-player-article-page />
        <!-- LIST OF AUDIO ARTICLES, SECTION END -->
        <!-- MORE AUDIO ARTICLES, SECTION START -->
        <div class="lv-con-pg-audio-button-more">
          <button type="button"
                  class="btn btn-primary btn-lg"
                  @click="showMore"
          >
            <i class="far fa-clock" />
            Mai multe articole audio!
          </button>
        </div>
        <!-- MORE AUDIO ARTICLES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import AudioPlayerArticlePage from './templates/AudioPlayerArticlePage.vue'

export default {
  name: 'AudioArticlesPage',
  components: {
    AudioPlayerArticlePage
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
      this.$router.push({ path: '/blog/audio' })
    }
  },
  metaInfo () {
    return { title: this.$t('user.audio_blog_page.page_title') }
  }
}
</script>
