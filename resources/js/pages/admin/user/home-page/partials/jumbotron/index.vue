<template>
  <div class="description-section">
    <h1>
      DESCRIPTION SECTION
    </h1>
    <div class="description-section-body">
      {{ displayAllUserJumbotronSection }}
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
  name: 'AdminUserJumbotron',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      allUserJumbotronSection: 'user_home_page/allUserJumbotronSection'
    }),
    displayAllUserJumbotronSection () {
      return this.allUserJumbotronSection.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.allUserCarouselSection.http_response_code
    }
  },
  created () {
    this.fetchUserJumbotronSection()
  },
  methods: {
    ...mapActions({
      fetchUserJumbotronSection: 'user_home_page/fetchUserJumbotronSection'
    })
  }
}
</script>
