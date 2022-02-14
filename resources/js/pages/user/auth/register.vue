<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-register">
        <card v-if="mustVerifyEmail" :title="$t('user.login_and_registration.register_form.title')">
          <div class="alert alert-success" role="alert">
            {{ $t('user.login_and_registration.register_form.input_name.verify_email_address') }}
          </div>
        </card>
        <card v-else :title="$t('user.login_and_registration.register_form.title')">
          <form @submit.prevent="register" @keydown="form.onKeydown($event)">
            <!-- NAME INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.register_form.input_name') }}
              </label>
              <div class="">
                <input v-model="form.name"
                       :class="{ 'is-invalid': form.errors.has('name') }"
                       class="form-control"
                       type="text"
                       name="name"
                       :placeholder="$t('user.login_and_registration.register_form.placeholder_name')"
                >
                <has-error :form="form" field="name" />
              </div>
            </div>
            <!-- NAME INPUT, SECTION END -->

            <!-- EMAIL INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.register_form.input_email') }}
              </label>
              <div class="">
                <input v-model="form.email"
                       :class="{ 'is-invalid': form.errors.has('email') }"
                       class="form-control"
                       type="email"
                       name="email"
                       :placeholder="$t('user.login_and_registration.register_form.placeholder_email')"
                >
                <has-error :form="form" field="email" />
              </div>
            </div>
            <!-- EMAIL INPUT, SECTION END -->

            <!-- PASSWORD INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.register_form.input_password') }}
              </label>
              <div class="">
                <input v-model="form.password"
                       :class="{ 'is-invalid': form.errors.has('password') }"
                       class="form-control"
                       type="password"
                       name="password"
                       :placeholder="$t('user.login_and_registration.register_form.placeholder_password')"
                >
                <has-error :form="form" field="password" />
              </div>
            </div>
            <!-- PASSWORD INPUT, SECTION END -->

            <!-- PASSWORD CONFIRMATION INPUT, SECTION START -->
            <div class="mb-4">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.register_form.input_confirm_password') }}
              </label>
              <div class="">
                <input v-model="form.password_confirmation"
                       :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                       class="form-control"
                       type="password"
                       name="password_confirmation"
                       :placeholder="$t('user.login_and_registration.register_form.placeholder_confirm_password')"
                >
                <has-error :form="form" field="password_confirmation" />
              </div>
            </div>
            <!-- PASSWORD CONFIRMATION INPUT, SECTION END -->

            <div class="my-4 d-flex form-button">
              <div class="col-md-6">
                <!-- REGISTER BUTTON, SECTION START -->
                <v-button :loading="form.busy">
                  {{ $t('user.login_and_registration.register_form.register_button') }}
                </v-button>
                <!-- REGISTER BUTTON, SECTION END -->
              </div>
              <div class="col-md-6">
                <!-- BACK TO LOGIN BUTTON, SECTION START -->
                <button class="btn btn-primary" @click="goToLoginForm()">
                  {{ $t('user.login_and_registration.register_form.back_to_login_button') }}
                </button>
                <!-- BACK TO LOGIN BUTTON, SECTION END -->
              </div>
            </div>

            <div class="my-4 d-flex form-button">
              <div class="col-md-6">
                <!-- FACEBOOK REGISTER BUTTON, SECTION START -->
                <login-with-facebook />
                <!-- FACEBOOK REGISTER BUTTON, SECTION END -->
              </div>
              <div class="col-md-6">
                <!-- INSTAGRAM REGISTER BUTTON, SECTION START -->
                <login-with-google />
                <!-- INSTAGRAM REGISTER BUTTON, SECTION END -->
              </div>
            </div>
          </form>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithFacebook from './social-media/LoginWithFacebook.vue'
import LoginWithGoogle from './social-media/LoginWithGoogle.vue'

export default {
  components: {
    LoginWithFacebook,
    LoginWithGoogle
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('user.login_and_registration.register_form.title') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    },

    goToLoginForm () {
      return this.$router.push({ name: 'user.auth.login' })
    }
  }
}
</script>
