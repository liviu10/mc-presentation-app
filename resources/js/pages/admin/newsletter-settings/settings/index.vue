<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <div class="card">
            <div class="card-body">
              <admin-resend-newsletter />
              <admin-change-newsletter-day />
              <admin-change-newsletter-welcome-template />
              <admin-change-newsletter-template />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters } from 'vuex'
import AdminResendNewsletter from './resend-newsletter.vue'
import AdminChangeNewsletterDay from './change-newsletter-day.vue'
import AdminChangeNewsletterWelcomeTemplate from './change-newsletter-welcome-template.vue'
import AdminChangeNewsletterTemplate from './change-newsletter-template.vue'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterSettings',
  components: {
    AdminResendNewsletter,
    AdminChangeNewsletterDay,
    AdminChangeNewsletterWelcomeTemplate,
    AdminChangeNewsletterTemplate
  },
  middleware: 'auth',
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>
