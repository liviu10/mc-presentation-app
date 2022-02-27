<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-reset-password">
        <card :title="$t('user.login_and_registration.reset_password_form.title')">
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
            <div class="d-flex form-button">
              <div class="col-md-6">
                <v-button :loading="form.busy">
                  {{ $t('user.login_and_registration.reset_password_form.reset_password_button') }}
                </v-button>
              </div>
              <div class="col-md-6">
                <!-- BACK TO LOGIN BUTTON, SECTION START -->
                <button class="btn btn-primary" @click="goToLoginForm()">
                  {{ $t('user.login_and_registration.reset_password_form.back_to_login_button') }}
                </button>
                <!-- BACK TO LOGIN BUTTON, SECTION END -->
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
    return { title: this.$t('user.login_and_registration.reset_password_form.title') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    },

    goToLoginForm () {
      return this.$router.push({ name: 'user.auth.login' })
    }
  }
}
</script>
