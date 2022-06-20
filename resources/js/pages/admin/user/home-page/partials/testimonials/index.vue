<template>
  <div class="testimonial-section">
    <h1>
      TESTIMONIALS SECTION
    </h1>
    <div class="testimonial-section-body">
      {{ displayAllUserTestimonialSection }}
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminUserTestimonials',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      allUserTestimonialSection: 'user_home_page/allUserTestimonialSection'
    }),
    displayAllUserTestimonialSection () {
      return this.allUserTestimonialSection.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.allUserCarouselSection.http_response_code
    }
  },
  created () {
    this.fetchUserTestimonialSection()
  },
  methods: {
    ...mapActions({
      fetchUserTestimonialSection: 'user_home_page/fetchUserTestimonialSection'
    })
  }
}
</script>
