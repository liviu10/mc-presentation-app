<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-login">
        <card :title="$t('user.login_and_registration.login_form.title')">
          <form @submit.prevent="login" @keydown="form.onKeydown($event)">
            <!-- EMAIL INPUT, SECTION START -->
            <div class="">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.login_form.input_email') }}
              </label>
              <div class="">
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
            <div class="">
              <label class="col-form-label">
                {{ $t('user.login_and_registration.login_form.input_password') }}
              </label>
              <div class="">
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
            <div class="my-4 d-flex form-options">
              <div class="col-md-6">
                <checkbox v-model="remember" name="remember">
                  {{ $t('user.login_and_registration.login_form.input_remember_me') }}
                </checkbox>
              </div>
              <div class="col-md-6">
                <router-link :to="{ name: 'user.auth.password.request' }" class="form-link">
                  {{ $t('user.login_and_registration.login_form.input_forgot_password') }}
                </router-link>
              </div>
            </div>
            <!-- REMEMBER ME & FORGOT PASSWORD, SECTION END -->

            <div class="my-2 d-flex form-button">
              <div class="col-md-12">
                <!-- LOGIN BUTTON, SECTION START -->
                <v-button :loading="form.busy">
                  {{ $t('user.login_and_registration.login_form.login_button') }}
                </v-button>
                <!-- LOGIN BUTTON, SECTION END -->
              </div>
            </div>

            <div class="my-2 d-flex form-button">
              <div class="col-md-12">
                <!-- FACEBOOK LOGIN BUTTON, SECTION START -->
                <login-with-facebook />
                <!-- FACEBOOK LOGIN BUTTON, SECTION END -->
              </div>
            </div>

            <div class="my-2 d-flex form-button">
              <div class="col-md-12">
                <!-- INSTAGRAM LOGIN BUTTON, SECTION START -->
                <login-with-google />
                <!-- INSTAGRAM LOGIN BUTTON, SECTION END -->
              </div>
            </div>

            <div class="alternative">
              <div class="line" />
              <span>{{ $t('user.login_and_registration.login_form.alternative_label') }}</span>
              <div class="line" />
            </div>

            <div class="my-2 d-flex form-button">
              <div class="col-md-12">
                <!-- REGISTER BUTTON, SECTION START -->
                <span>
                  {{ $t('user.login_and_registration.login_form.register_line_1') }}
                  <a href="/register">{{ $t('user.login_and_registration.login_form.register_line_2') }}</a>
                </span>
                <!-- REGISTER BUTTON, SECTION END -->
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
        this.$router.push({ path: this.$router.history._startLocation })
      }
    }
  }
}
</script>
