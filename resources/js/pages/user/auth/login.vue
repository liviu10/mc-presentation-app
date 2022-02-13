<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <card :title="$t('user.login_and_registration.login_form.title')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- EMAIL INPUT, SECTION START -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">
              {{ $t('user.login_and_registration.login_form.input_email') }}
            </label>
            <div class="col-md-7">
              <input v-model="form.email"
                     :class="{ 'is-invalid': form.errors.has('email') }"
                     class="form-control"
                     type="email" name="email"
                     :placeholder="$t('user.login_and_registration.login_form.placeholder_email')"
              >
              <has-error :form="form" field="email" />
            </div>
          </div>
          <!-- EMAIL INPUT, SECTION END -->

          <!-- PASSWORD INPUT, SECTION START -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">
              {{ $t('user.login_and_registration.login_form.input_password') }}
            </label>
            <div class="col-md-7">
              <input v-model="form.password"
                     :class="{ 'is-invalid': form.errors.has('password') }"
                     class="form-control"
                     type="password"
                     name="password"
                     :placeholder="$t('user.login_and_registration.login_form.placeholder_password')"
              >
              <has-error :form="form" field="password" />
            </div>
          </div>
          <!-- PASSWORD INPUT, SECTION END -->

          <!-- REMEMBER ME & FORGOT PASSWORD, SECTION START -->
          <div class="mb-3 row">
            <div class="col-md-3" />
            <div class="col-md-7 d-flex">
              <checkbox v-model="remember" name="remember">
                {{ $t('user.login_and_registration.login_form.input_remember_me') }}
              </checkbox>
              <router-link :to="{ name: 'user.auth.password.request' }" class="small ms-auto my-auto">
                {{ $t('user.login_and_registration.login_form.input_forgot_password') }}
              </router-link>
            </div>
          </div>
          <!-- REMEMBER ME & FORGOT PASSWORD, SECTION END -->

          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- LOGIN BUTTON, SECTION START -->
              <v-button :loading="form.busy">
                {{ $t('user.login_and_registration.login_form.login_button') }}
              </v-button>
              <!-- LOGIN BUTTON, SECTION END -->

              <!-- REGISTER BUTTON, SECTION START -->
              <a href="/register" class="btn btn-primary">
                {{ $t('user.login_and_registration.login_form.register_button') }}
              </a>
              <!-- REGISTER BUTTON, SECTION END -->
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- FACEBOOK LOGIN BUTTON, SECTION START -->
              <login-with-facebook />
              <!-- FACEBOOK LOGIN BUTTON, SECTION END -->

              <!-- INSTAGRAM LOGIN BUTTON, SECTION START -->
              <login-with-google />
              <!-- INSTAGRAM LOGIN BUTTON, SECTION END -->
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LoginWithFacebook from './social-media/LoginWithFacebook.vue'
import LoginWithGoogle from './social-media/LoginWithGoogle.vue'

export default {
  components: {
    LoginWithFacebook,
    LoginWithGoogle
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('user.login_and_registration.login_form.title') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home-page' })
      }
    }
  }
}
</script>
