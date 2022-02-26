<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div v-if="success" class="lv-pg-register-verify-email">
        <card class="card-verify-email" :title="$t('user.login_and_registration.reset_password_form.verify_email')">
          <div class="alert alert-success" role="alert">
            {{ success }}
          </div>
          <router-link :to="{ name: 'home-page' }" class="btn btn-primary">
            {{ $t('user.login_and_registration.login_form.login_button') }}
          </router-link>
        </card>
      </div>
      <div v-else class="lv-pg-register-verify-email">
        <card class="card-verify-email" :title="$t('user.login_and_registration.reset_password_form.verify_email')">
          <div class="alert alert-danger" role="alert">
            {{ error || $t('user.login_and_registration.reset_password_form.failed_to_verify_email') }}
          </div>

          <router-link :to="{ name: 'user.auth.verification.resend' }" class="small float-end">
            {{ $t('user.login_and_registration.reset_password_form.resend_verification_link') }}
          </router-link>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

const qs = (params) => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  async beforeRouteEnter (to, from, next) {
    try {
      const { data } = await axios.post(`/api/email/verify/${to.params.id}?${qs(to.query)}`)

      next(vm => { vm.success = data.status })
    } catch (e) {
      next(vm => { vm.error = e.response.data.status })
    }
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('user.login_and_registration.reset_password_form.verify_email') }
  },

  data: () => ({
    error: '',
    success: ''
  })
}
</script>
