<template>
  <div class="footer-section">
    <h1>
      FOOTER SECTION
    </h1>
    <div class="footer-section-body">
      {{ displayAllUserFooterSection }}
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
  name: 'AdminUserFooter',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      allUserFooterSection: 'user_home_page/allUserFooterSection'
    }),
    displayAllUserFooterSection () {
      return this.allUserFooterSection.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.allUserCarouselSection.http_response_code
    }
  },
  created () {
    this.fetchUserFooterSection()
  },
  methods: {
    ...mapActions({
      fetchUserFooterSection: 'user_home_page/fetchUserFooterSection'
    })
  }
}
</script>
