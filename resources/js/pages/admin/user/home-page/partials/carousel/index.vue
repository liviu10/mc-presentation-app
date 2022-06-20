<template>
  <div class="carousel-section">
    <h1>
      CAROUSEL SECTION
    </h1>
    <div class="carousel-section-body">
      {{ displayAllUserCarouselSection }}
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
  name: 'AdminUserCarousel',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      allUserCarouselSection: 'user_home_page/allUserCarouselSection'
    }),
    displayAllUserCarouselSection () {
      return this.allUserCarouselSection.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.allUserCarouselSection.http_response_code
    }
  },
  created () {
    this.fetchUserCarouselSection()
  },
  methods: {
    ...mapActions({
      fetchUserCarouselSection: 'user_home_page/fetchUserCarouselSection'
    })
  }
}
</script>
