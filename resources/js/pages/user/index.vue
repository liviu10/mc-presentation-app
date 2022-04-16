<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <!-- CAROUSEL, SECTION START -->
      <!-- <home-page-carousel /> -->
      <home-page-carousel-version-1 />
      <!-- CAROUSEL, SECTION END -->

      <!-- HEADING, SECTION START -->
      <home-page-heading />
      <!-- HEADING, SECTION END -->

      <!-- MAIN CATEGORIES, SECTION START -->
      <main-categories />
      <!-- MAIN CATEGORIES, SECTION END -->

      <!-- TESTIMONIALS, SECTION START -->
      <home-page-testimonials />
      <!-- TESTIMONIALS, SECTION END -->

      <!-- NEWSLETTER, SECTION START -->
      <home-page-newsletter />
      <!-- NEWSLETTER, SECTION END -->
    </div>
  </div>
</template>

<script>
// import HomePageCarousel from './partials/HomePageCarousel.vue'
import HomePageCarouselVersion1 from './partials/HomePageCarousel-v1.vue'
import HomePageHeading from './partials/HomePageHeading.vue'
import MainCategories from './blog/partials/MainCategories.vue'
import HomePageTestimonials from './partials/HomePageTestimonials.vue'
import HomePageNewsletter from './partials/HomePageNewsletter.vue'

export default {
  name: 'HomePage',
  components: {
    // HomePageCarousel,
    HomePageCarouselVersion1,
    HomePageHeading,
    MainCategories,
    HomePageTestimonials,
    HomePageNewsletter
  },
  metaInfo () {
    return { title: this.$t('user.home_page.page_title') }
  }
}
</script>
