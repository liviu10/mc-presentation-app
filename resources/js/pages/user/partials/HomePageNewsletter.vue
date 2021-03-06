<template>
  <div class="container lv-con-newsletter">
    <div class="lv-con-newsletter-head">
      <h1>Abonare la newsletter</h1>
    </div>
    <form @submit.prevent="subscribe" @keydown="form.onKeydown($event)">
      <div class="row">
        <!-- FULL NAME, SECTION START -->
        <div class="lv-con-newsletter-form col-xxl-5 col-xl-5 col-lg-5">
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
        <div class="lv-con-newsletter-form col-xxl-5 col-xl-5 col-lg-5">
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
        <div class="lv-con-newsletter-form col-xxl-2 col-xl-2 col-lg-2">
          <button type="submit" class="btn btn-success">
            {{ $t('user.home_page.newsletter.subscribe_button') }}
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
              {{ $t('user.home_page.newsletter.i_agree_with') }}
            </label>
            <a class="lead a-typography" href="/terms-and-conditions">
              {{ $t('user.home_page.newsletter.privacy_policy') }}
            </a>
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
  data: function () {
    return {
      form: new Form({
        full_name: '',
        email: '',
        privacy_policy: false
      }),
      subscriberFullName: '',
      subscriberEmailAddress: '',
      newsletterImages: [
        'images/pages/home/newsletter/newsletter_img0_259.webp',
        'images/pages/home/newsletter/newsletter_img1_259.webp',
        'images/pages/home/newsletter/newsletter_img2_259.webp',
        'images/pages/home/newsletter/newsletter_img3_259.webp',
        'images/pages/home/newsletter/newsletter_img4_259.webp',
        'images/pages/home/newsletter/newsletter_img5_259.webp',
        'images/pages/home/newsletter/newsletter_img6_259.webp',
        'images/pages/home/newsletter/newsletter_img7_259.webp',
        'images/pages/home/newsletter/newsletter_img8_259.webp',
        'images/pages/home/newsletter/newsletter_img9_259.webp',
        'images/pages/home/newsletter/newsletter_img10_259.webp',
        'images/pages/home/newsletter/newsletter_img11_259.webp',
        'images/pages/home/newsletter/newsletter_img12_259.webp',
        'images/pages/home/newsletter/newsletter_img13_259.webp',
        'images/pages/home/newsletter/newsletter_img14_259.webp',
        'images/pages/home/newsletter/newsletter_img15_259.webp'
      ],
      newsletterSelectedImage: null
    }
  },
  created () {
    this.newsletterSelectedImage = this.displayRandomNewsletterImage(this.newsletterImages)
  },
  methods: {
    displayRandomNewsletterImage (images) {
      return images[Math.floor(Math.random() * images.length)]
    },
    async subscribe () {
      const url = window.location.origin
      const apiEndPoint = '/api/subscribe'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          full_name: this.form.full_name,
          email: this.form.email,
          privacy_policy: this.form.privacy_policy
        })
        .then(response => {
          console.log('> subscriber full name: ', response.data)
          this.subscriberFullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.home_page.newsletter.swal.title', { subscriberFullName: this.subscriberFullName }),
            text: this.$t('user.home_page.newsletter.swal.message'),
            imageUrl: this.displayRandomNewsletterImage(this.newsletterImages),
            imageWidth: 259,
            imageHeight: 194
          }).then((result) => {
            this.form.full_name = ''
            this.form.email = ''
            this.form.privacy_policy = false
          })
        })
        .catch(error => {
          this.subscriberFullName = error.response.config.full_name
          this.subscriberEmailAddress = error.response.config.email
          if (error.response.status === 406 || error.response.status === 500) {
            Swal.fire({
              title: this.$t('user.home_page.newsletter.swal_error.title', { subscriberFullName: this.subscriberFullName }),
              text: this.$t('user.home_page.newsletter.swal_error.message', { subscriberEmailAddress: this.subscriberEmailAddress }),
              imageUrl: this.displayRandomNewsletterImage(this.newsletterImages),
              imageWidth: 259,
              imageHeight: 194
            })
          }
          if (error.response.status === 422) {
            Swal.fire({
              title: this.$t('user.home_page.newsletter.swal_warning.title', { subscriberFullName: this.subscriberFullName }),
              text: this.$t('user.home_page.newsletter.swal_warning.message', { subscriberEmailAddress: this.subscriberEmailAddress }),
              imageUrl: this.displayRandomNewsletterImage(this.newsletterImages),
              imageWidth: 259,
              imageHeight: 194
            })
          }
        })
    }
  }
}
</script>
