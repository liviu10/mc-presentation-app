<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-user-home">
        <div class="lv-pg-admin-user-home-header">
          <h1>USER HOME PAGE & SECTIONS</h1>
        </div>
        <div class="lv-pg-admin-user-home-body">
          <!-- CAROUSEL, SECTION START -->
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title">
                Carousel
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <button v-if="hideSeeSectionButtonCarousel" class="btn btn-primary btn-section" @click="displayCarouselSection()">
                <fa icon="eye" fixed-width />
                See section
              </button>
              <button v-if="displayCloseSectionButtonCarousel" class="btn btn-primary btn-section" @click="closeCarouselSection()">
                <fa icon="times" fixed-width />
                Close section
              </button>
            </div>
            <div v-if="displayCarousel" class="card-body">
              <admin-user-carousel />
            </div>
          </div>
          <!-- CAROUSEL, SECTION END -->

          <!-- JUMBOTRON, SECTION START -->
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title">
                Description
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <button v-if="hideSeeSectionButtonDescription" class="btn btn-primary btn-section" @click="displayDescriptionSection()">
                <fa icon="eye" fixed-width />
                See section
              </button>
              <button v-if="displayCloseSectionButtonDescription" class="btn btn-primary btn-section" @click="closeDescriptionSection()">
                <fa icon="times" fixed-width />
                Close section
              </button>
            </div>
            <div v-if="displayDescription" class="card-body">
              <admin-user-jumbotron />
            </div>
          </div>
          <!-- JUMBOTRON, SECTION END -->

          <!-- TESTIMONIALS, SECTION START -->
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title">
                Testimonials
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <button v-if="hideSeeSectionButtonTestimonials" class="btn btn-primary btn-section" @click="displayTestimonialsSection()">
                <fa icon="eye" fixed-width />
                See section
              </button>
              <button v-if="displayCloseSectionButtonTestimonials" class="btn btn-primary btn-section" @click="closeTestimonialsSection()">
                <fa icon="times" fixed-width />
                Close section
              </button>
            </div>
            <div v-if="displayTestimonials" class="card-body">
              <admin-user-testimonials />
            </div>
          </div>
          <!-- TESTIMONIALS, SECTION END -->

          <!-- NEWSLETTER, SECTION START -->
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title">
                Newsletter
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <button v-if="hideSeeSectionButtonNewsletter" class="btn btn-primary btn-section" @click="displayNewsletterSection()">
                <fa icon="eye" fixed-width />
                See section
              </button>
              <button v-if="displayCloseSectionButtonNewsletter" class="btn btn-primary btn-section" @click="closeNewsletterSection()">
                <fa icon="times" fixed-width />
                Close section
              </button>
            </div>
            <div v-if="displayNewsletter" class="card-body">
              <admin-user-newsletter />
            </div>
          </div>
          <!-- NEWSLETTER, SECTION END -->

          <!-- FOOTER, SECTION START -->
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title">
                Footer
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <button v-if="hideSeeSectionButtonFooter" class="btn btn-primary btn-section" @click="displayFooterSection()">
                <fa icon="eye" fixed-width />
                See section
              </button>
              <button v-if="displayCloseSectionButtonFooter" class="btn btn-primary btn-section" @click="closeFooterSection()">
                <fa icon="times" fixed-width />
                Close section
              </button>
            </div>
            <div v-if="displayFooter" class="card-body">
              <admin-user-footer />
            </div>
          </div>
          <!-- FOOTER, SECTION END -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminUserCarousel from './partials/carousel/index.vue'
import AdminUserJumbotron from './partials/jumbotron/index.vue'
import AdminUserTestimonials from './partials/testimonials/index.vue'
import AdminUserNewsletter from './partials/newsletter/index.vue'
import AdminUserFooter from './partials/footer/index.vue'

export default {
  name: 'AdminUserHomePageAndSections',
  components: {
    AdminUserCarousel,
    AdminUserJumbotron,
    AdminUserTestimonials,
    AdminUserNewsletter,
    AdminUserFooter
  },
  middleware: 'auth',
  data: function () {
    return {
      displayCarousel: false,
      hideSeeSectionButtonCarousel: true,
      displayCloseSectionButtonCarousel: false,
      displayDescription: false,
      hideSeeSectionButtonDescription: true,
      displayCloseSectionButtonDescription: false,
      displayTestimonials: false,
      hideSeeSectionButtonTestimonials: true,
      displayCloseSectionButtonTestimonials: false,
      displayNewsletter: false,
      hideSeeSectionButtonNewsletter: true,
      displayCloseSectionButtonNewsletter: false,
      displayFooter: false,
      hideSeeSectionButtonFooter: true,
      displayCloseSectionButtonFooter: false
    }
  },
  methods: {
    displayCarouselSection () {
      this.displayCarousel = true
      this.hideSeeSectionButtonCarousel = false
      this.displayCloseSectionButtonCarousel = true
    },
    closeCarouselSection () {
      this.displayCarousel = false
      this.hideSeeSectionButtonCarousel = true
      this.displayCloseSectionButtonCarousel = false
    },
    displayDescriptionSection () {
      this.displayDescription = true
      this.hideSeeSectionButtonDescription = false
      this.displayCloseSectionButtonDescription = true
    },
    closeDescriptionSection () {
      this.displayDescription = false
      this.hideSeeSectionButtonDescription = true
      this.displayCloseSectionButtonDescription = false
    },
    displayTestimonialsSection () {
      this.displayTestimonials = true
      this.hideSeeSectionButtonTestimonials = false
      this.displayCloseSectionButtonTestimonials = true
    },
    closeTestimonialsSection () {
      this.displayTestimonials = false
      this.hideSeeSectionButtonTestimonials = true
      this.displayCloseSectionButtonTestimonials = false
    },
    displayNewsletterSection () {
      this.displayNewsletter = true
      this.hideSeeSectionButtonNewsletter = false
      this.displayCloseSectionButtonNewsletter = true
    },
    closeNewsletterSection () {
      this.displayNewsletter = false
      this.hideSeeSectionButtonNewsletter = true
      this.displayCloseSectionButtonNewsletter = false
    },
    displayFooterSection () {
      this.displayFooter = true
      this.hideSeeSectionButtonFooter = false
      this.displayCloseSectionButtonFooter = true
    },
    closeFooterSection () {
      this.displayFooter = false
      this.hideSeeSectionButtonFooter = true
      this.displayCloseSectionButtonFooter = false
    }
  },
  metaInfo () {
    return { title: 'Admin - User Home Page & Sections' }
  }
}
</script>
