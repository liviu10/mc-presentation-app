<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-reset-password">
        <card :title="$t('user.login_and_registration.reset_password_form.title')">
          <form @submit.prevent="reset" @keydown="form.onKeydown($event)">
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
                       readonly
                       :placeholder="$t('user.login_and_registration.reset_password_form.placeholder_email')"
                >
                <has-error :form="form" field="email" />
              </div>
            </div>
            <!-- EMAIL INPUT, SECTION END -->

            <!-- PASSWORD INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.reset_password_form.input_password') }}
              </label>
              <div class="">
                <input v-model="form.password"
                       :class="{ 'is-invalid': form.errors.has('password') }"
                       class="form-control"
                       type="password"
                       name="password"
                       :placeholder="$t('user.login_and_registration.reset_password_form.placeholder_password')"
                >
                <has-error :form="form" field="password" />
              </div>
            </div>
            <!-- PASSWORD INPUT, SECTION END -->

            <!-- PASSWORD CONFIRMATION INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.reset_password_form.input_confirm_password') }}
              </label>
              <div class="">
                <input v-model="form.password_confirmation"
                       :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                       class="form-control"
                       type="password"
                       name="password_confirmation"
                       :placeholder="$t('user.login_and_registration.reset_password_form.placeholder_confirm_password')"
                >
                <has-error :form="form" field="password_confirmation" />
              </div>
            </div>
            <!-- PASSWORD CONFIRMATION INPUT, SECTION END -->

            <!-- RESET PASSWORD BUTTON, SECTION START -->
            <div class="mb-4 d-flex form-button">
              <div class="col-md-12">
                <v-button :loading="form.busy">
                  {{ $t('user.login_and_registration.reset_password_form.reset_password_label') }}
                </v-button>
              </div>
            </div>
          <!-- RESET PASSWORD BUTTON, SECTION END -->
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
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    async reset () {
      const { data } = await this.form.post('/api/password/reset')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
