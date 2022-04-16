<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-reset-password">
        <card :title="$t('user.login_and_registration.reset_password_form.verify_email')">
          <form @submit.prevent="send" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="status" />

            <!-- EMAIL INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.reset_password_form.input_email') }}
              </label>
              <div class="">
                <input v-model="form.email"
                       :class="{ 'is-invalid': form.errors.has('email') }"
                       class="form-control"
                       type="email"
                       name="email"
                       :placeholder="$t('user.login_and_registration.reset_password_form.placeholder_email')"
                >
                <has-error :form="form" field="email" />
              </div>
            </div>
            <!-- EMAIL INPUT, SECTION END -->

            <!-- SEND RESET LINK, SECTION START -->
            <div class="mb-4 d-flex form-button">
              <div class="col-md-12">
                <v-button :loading="form.busy">
                  {{ $t('user.login_and_registration.reset_password_form.send_verification_link') }}
                </v-button>
              </div>
            </div>
          <!-- SEND RESET LINK, SECTION END -->
          </form>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('user.login_and_registration.reset_password_form.verify_email') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  created () {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  },

  methods: {
    async send () {
      const { data } = await this.form.post('/api/email/resend')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
