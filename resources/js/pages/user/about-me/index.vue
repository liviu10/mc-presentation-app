<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-about-me">
        <!-- ABOUT ME VIDEO, SECTION START -->
        <div class="lv-pg-about-me-video">
          <!-- <video controls>
            <source src="/videos/about_me.mp4" type="video/mp4">
          </video> -->
          <iframe
            width="640"
            height="480"
            src="https://www.youtube.com/embed/gsnqXt7d1mU"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          />
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
  metaInfo () {
    return { title: this.$t('user.about_me_page.page_title') }
  }
}
</script>
