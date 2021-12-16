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
          <button type="submit" class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 btn btn-success">
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
              <span @click="acceptPrivacyPolicy">
                {{ $t('user.home_page.newsletter.i_agree_with') }}
                <router-link class="a-typography" to="/terms-and-conditions">
                  {{ $t('user.home_page.newsletter.privacy_policy') }}
                </router-link>
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
  data: function () {
    return {
      form: new Form({
        full_name: '',
        email: '',
        privacy_policy: false
      }),
      subscriberFullName: '',
      newsletterImages: [
        'images/newsletter/newsletter_img0.jpg',
        'images/newsletter/newsletter_img1.jpg',
        'images/newsletter/newsletter_img2.jpg',
        'images/newsletter/newsletter_img3.jpg',
        'images/newsletter/newsletter_img4.jpg',
        'images/newsletter/newsletter_img5.jpg',
        'images/newsletter/newsletter_img6.jpg',
        'images/newsletter/newsletter_img7.jpg',
        'images/newsletter/newsletter_img8.jpg',
        'images/newsletter/newsletter_img9.jpg',
        'images/newsletter/newsletter_img10.jpg',
        'images/newsletter/newsletter_img11.jpg',
        'images/newsletter/newsletter_img12.jpg',
        'images/newsletter/newsletter_img13.jpg',
        'images/newsletter/newsletter_img14.jpg',
        'images/newsletter/newsletter_img15.jpg'
      ],
      newsletterSelectedImage: null
    }
  },
  created () {
    this.newsletterSelectedImage = this.displayRandomNewsletterImage(this.newsletterImages)
  },
  methods: {
    acceptPrivacyPolicy () {
      if (this.form.privacy_policy === true) {
        this.form.privacy_policy = false
      } else {
        this.form.privacy_policy = true
      }
    },
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
          this.subscriberFullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.home_page.newsletter.swal.title', { subscriberFullName: this.subscriberFullName }),
            text: this.$t('user.home_page.newsletter.swal.message'),
            imageUrl: this.displayRandomNewsletterImage(this.newsletterImages),
            imageWidth: 259,
            imageHeight: 194
          }).then((result) => {
            console.log(result)
            this.form.full_name = null
            this.form.email = null
            this.form.privacy_policy = null
          })
        })
    }
  }
}
</script>
