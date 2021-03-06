<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-contact">
        <!-- PICTURE PAGE, SECTION START -->
        <div class="card" style="width: 20rem;">
          <img src="images/pages/contact_me/dance-question-mark_600.webp" class="card-img-top" alt="...">
        </div>
        <!-- PICTURE PAGE, SECTION END -->

        <!-- CONTACT FORM, SECTION START -->
        <div class="lv-pg-contact-content">
          <div class="lv-pg-contact-content-header">
            <h1>{{ $t('user.contact_me_page.title') }}</h1>
            <p class="lead">
              {{ $t('user.contact_me_page.page_content.paragraph_1') }}
            </p>
            <p class="lead">
              {{ $t('user.contact_me_page.page_content.paragraph_2') }}
            </p>
            <p class="lead">
              {{ $t('user.contact_me_page.page_content.paragraph_3') }}
            </p>
            <p class="lead">
              {{ $t('user.contact_me_page.page_content.paragraph_4') }}
            </p>
          </div>
          <div class="card-alternative m-auto" style="width: 20rem;">
            <img src="images/pages/contact_me/dance-question-mark_600.webp" class="card-img-top" alt="...">
          </div>
          <div class="lv-pg-contact-content-body">
            <form @submit.prevent="contactMe" @keydown="form.onKeydown($event)">
              <!-- FULL NAME, SECTION START -->
              <div class="mb-4">
                <input id="contact_full_name"
                       v-model="form.full_name"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('full_name') }"
                       class="form-control"
                       :placeholder="$t('user.contact_me_page.contact_form.input_full_name')"
                       name="full_name"
                >
                <has-error :form="form" field="full_name" />
              </div>
              <!-- FULL NAME, SECTION END -->
              <!-- EMAIL ADDRESS, SECTION START -->
              <div class="mb-4">
                <input id="contact_email"
                       v-model="form.email"
                       type="email"
                       :class="{ 'is-invalid': form.errors.has('email') }"
                       class="form-control"
                       :placeholder="$t('user.contact_me_page.contact_form.input_email_address')"
                       name="email"
                >
                <has-error :form="form" field="email" />
              </div>
              <!-- EMAIL ADDRESS, SECTION END -->
              <!-- MESSAGE, SECTION START -->
              <div class="mb-4">
                <textarea id="contact_message"
                          v-model="form.message"
                          :class="{ 'is-invalid': form.errors.has('email') }"
                          class="form-control form-message"
                          :placeholder="$t('user.contact_me_page.contact_form.input_message')"
                          name="message"
                />
                <has-error :form="form" field="message" />
              </div>
              <!-- MESSAGE, SECTION END -->
              <!-- PRIVACY POLICY, SECTION START -->
              <div class="my-4 form-check">
                <div class="form-check-privacy-policy">
                  <input id="contact_privacy_policy"
                         v-model="form.privacy_policy"
                         type="checkbox"
                         :class="{ 'is-invalid': form.errors.has('privacy_policy') }"
                         class="form-check-input"
                         name="privacy_policy"
                  >
                  <label class="form-check-label lead" for="contact_privacy_policy">
                    {{ $t('user.contact_me_page.contact_form.i_agree_with') }}
                  </label>
                  <a class="lead a-typography" href="/terms-and-conditions">
                    {{ $t('user.contact_me_page.contact_form.privacy_policy') }}
                  </a>
                </div>
                <has-error :form="form" field="privacy_policy" />
              </div>
              <!-- PRIVACY POLICY, SECTION END -->
              <div class="form-button">
                <button type="submit" class="btn btn-primary">
                  {{ $t('user.contact_me_page.contact_form.contact_form_button') }}
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- CONTACT FORM, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

export default {
  name: 'ContactMePage',
  data: function () {
    return {
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  methods: {
    async contactMe () {
      const url = window.location.origin
      const apiEndPoint = '/api/contact-me'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          full_name: this.form.full_name,
          email: this.form.email,
          message: this.form.message,
          privacy_policy: this.form.privacy_policy
        })
        .then(response => {
          this.senderFullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.contact_me_page.contact_form.swal.title', { senderFullName: this.senderFullName }),
            text: this.$t('user.contact_me_page.contact_form.swal.message')
          }).then((result) => {
            this.form.full_name = null
            this.form.email = null
            this.form.message = null
            this.form.privacy_policy = null
          })
        })
        .catch(error => {
          this.senderFullName = error.response.config.full_name
          this.senderEmailAddress = error.response.config.email
          if (error.response.status === 406 || error.response.status === 500) {
            Swal.fire({
              title: this.$t('user.contact_me_page.contact_form.swal_error.title', { senderFullName: this.senderFullName }),
              text: this.$t('user.contact_me_page.contact_form.swal_error.message', { senderEmailAddress: this.senderEmailAddress })
            })
          }
          if (error.response.status === 422) {
            Swal.fire({
              title: this.$t('user.contact_me_page.contact_form.swal_warning.title'),
              text: this.$t('user.contact_me_page.contact_form.swal_warning.message')
            })
          }
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.contact_me_page.page_title') }
  }
}
</script>
