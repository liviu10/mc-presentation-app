<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-about-me">
        <!-- ABOUT ME VIDEO, SECTION START -->
        <div class="lv-pg-about-me-video">
          <video controls>
            <source src="/videos/demo_video.mp4" type="video/mp4">
          </video>
        </div>
        <!-- ABOUT ME VIDEO, SECTION END -->
        <!-- TIMELINE, SECTION START -->
        <about-me-timeline />
        <!-- TIMELINE, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import AboutMeTimeline from '~/pages/user/about-me/partials/AboutMeTimeline.vue'

export default {
  name: 'AboutMe',
  components: {
    AboutMeTimeline
  },
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {}
  },
  computed: {
    // mapped getters}
  },
  mounted () {},
  methods: {},
  metaInfo () {
    return { title: this.$t('user.about_me_page.page_title') }
  }
}
</script>
