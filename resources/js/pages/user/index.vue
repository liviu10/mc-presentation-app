<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <!-- CAROUSEL, SECTION START -->
      <home-page-carousel />
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
import HomePageCarousel from '~/components/home_page/HomePageCarousel.vue'
import HomePageHeading from '~/components/home_page/HomePageHeading.vue'
import MainCategories from '~/pages/user/blog/partials/MainCategories.vue'
import HomePageTestimonials from '~/components/home_page/HomePageTestimonials.vue'
import HomePageNewsletter from '~/components/home_page/HomePageNewsletter.vue'

export default {
  name: 'HomePage',
  components: {
    HomePageCarousel,
    HomePageHeading,
    MainCategories,
    HomePageTestimonials,
    HomePageNewsletter
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
      this.$router.push({ path: '/blog/article' })
    }
  },
  metaInfo () {
    return { title: this.$t('user.home_page.page_title') }
  }
}
</script>
