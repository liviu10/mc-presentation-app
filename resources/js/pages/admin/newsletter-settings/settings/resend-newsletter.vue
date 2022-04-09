<template>
  <div class="row">
    <div class="col">
      <p class="card-text">
        Press the button below to retry resending the email newsletter
      </p>
      <p class="card-text">
        <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2" class="btn btn-primary" type="button">
          Resend newsletter email
        </button>
      </p>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminResendNewsletter',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>
