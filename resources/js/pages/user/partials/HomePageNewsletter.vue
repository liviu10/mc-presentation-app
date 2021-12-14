<template>
  <div class="container lv-con-newsletter">
    <form @submit.prevent="subscribe" @keydown="form.onKeydown($event)">
      <div class="row">
        <!-- FULL NAME, SECTION START -->
        <div class="col col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
          <input id="subscriber_full_name"
                 v-model="form.full_name"
                 type="text"
                 :class="{ 'is-invalid': form.errors.has('full_name') }"
                 class="form-control"
                 :placeholder="$t('user.home_page.newsletter.input_full_name')"
                 name="full_name"
          >
          <has-error :form="form" field="full_name" />
        </div>
        <!-- FULL NAME, SECTION END -->
        <!-- EMAIL ADDRESS, SECTION START -->
        <div class="col col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
          <input id="subscriber_email"
                 v-model="form.email"
                 type="email"
                 :class="{ 'is-invalid': form.errors.has('email') }"
                 class="form-control"
                 :placeholder="$t('user.home_page.newsletter.input_email_address')"
                 name="email"
          >
          <has-error :form="form" field="email" />
        </div>
        <!-- EMAIL ADDRESS, SECTION END -->
        <div class="col col-xxl-2 col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
          <button type="submit"
                  class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 btn btn-success"
          >
            {{ capitalizeSubscribeButton }}
          </button>
        </div>
      </div>
      <div class="row">
        <!-- PRIVACY POLICY, SECTION START -->
        <div class="form-check">
          <div class="form-check-privacy-policy">
            <input id="privacy_policy"
                   v-model="form.privacy_policy"
                   type="checkbox"
                   :class="{ 'is-invalid': form.errors.has('privacy_policy') }"
                   class="form-check-input"
                   name="privacy_policy"
            >
            <label class="form-check-label lead" for="privacy_policy">
              <span @click="acceptPrivacyPolicy">
                {{ $t('user.home_page.newsletter.i_agree_with') }}
                <span class="a-typography"
                      @click="redirectToPrivacyPolicy"
                >
                  {{ $t('user.home_page.newsletter.privacy_policy') }}
                </span>
              </span>
            </label>
          </div>
          <has-error :form="form" field="privacy_policy" />
        </div>
        <!-- PRIVACY POLICY, SECTION END -->
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

export default {
  name: 'HomePageNewsletter',
  components: {},
  data: function () {
    return {
      form: new Form({
        full_name: '',
        email: '',
        privacy_policy: false
      })
    }
  },
  computed: {
    capitalizeSubscribeButton () {
      const subscribeButtonLabel = this.$t('user.home_page.newsletter.subscribe_button')
      return subscribeButtonLabel.toUpperCase()
    }
  },
  methods: {
    acceptPrivacyPolicy () {
      if (this.form.privacy_policy === true) {
        this.form.privacy_policy = false
      } else {
        this.form.privacy_policy = true
      }
    },
    redirectToPrivacyPolicy () {
      this.$router.push({ name: 'terms-and-conditions' })
    },
    async subscribe () {
      const url = window.location.origin
      const apiEndPoint = '/api/subscribe'
      const fullApiUrl = url + apiEndPoint
      const { data } = await this.form.post(fullApiUrl)
      console.log('>>>>>> Newsletter Api URL: ', data)
      Swal.fire({
        title: this.$t('user.home_page.newsletter.swal.title'),
        text: this.$t('user.home_page.newsletter.swal.message'),
        imageUrl: 'https://unsplash.it/400/200',
        imageWidth: 320,
        imageHeight: 240,
        imageAlt: ''
      }).then((result) => {
        this.form.full_name = null
        this.form.email = null
        this.form.privacy_policy = null
      })
    }
  }
}
</script>
