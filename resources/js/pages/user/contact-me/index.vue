<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-contact-form">
        <!-- PICTURE PAGE, SECTION START -->
        <div class="card" style="width: 20rem;">
          <img src="images/contact/dance-question-mark.jpg" class="card-img-top" alt="...">
        </div>
        <!-- PICTURE PAGE, SECTION END -->

        <!-- CONTACT FORM, SECTION START -->
        <div class="container-contact-form">
          <div class="container-contact-form-head">
            <h1>{{ $t('user.contact_me_page.title') }}</h1>
            <p class="lead">
              {{ $t('user.contact_me_page.paragraph') }}
            </p>
          </div>
          <div class="card-alternative m-auto" style="width: 20rem;">
            <img src="images/contact/dance-question-mark.jpg" class="card-img-top" alt="...">
          </div>
          <div class="container-contact-form-main">
            <form @submit.prevent="subscribe" @keydown="form.onKeydown($event)">
              <alert-success :form="form" :message="message_success" />
              <!-- FULL NAME, SECTION START -->
              <div class="mb-4">
                <input id="full_name"
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
                <input id="email"
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
                <textarea id="message"
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
                  <input id="privacy_policy"
                         v-model="form.privacy_policy"
                         type="checkbox"
                         :class="{ 'is-invalid': form.errors.has('privacy_policy') }"
                         class="form-check-input"
                         name="privacy_policy"
                  >
                  <label class="form-check-label lead" for="flexCheckChecked">
                    <span @click="acceptPrivacyPolicy">
                      {{ $t('user.contact_me_page.contact_form.i_agree_with') }}
                      <span class="a-typography"
                            @click="redirectToPrivacyPolicy"
                      >
                        {{ $t('user.contact_me_page.contact_form.privacy_policy') }}
                      </span>
                    </span>
                  </label>
                </div>
                <has-error :form="form" field="privacy_policy" />
              </div>
              <!-- PRIVACY POLICY, SECTION END -->
              <div class="form-button">
                <button type="submit" class="btn btn-primary">
                  {{ capitalizeSendMessageButton }}
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

export default {
  name: 'ContactMePage',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      message_success: this.$t('user.contact_me_page.contact_form.message_sent'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  computed: {
    // mapped getters
    capitalizeSendMessageButton () {
      const sendMessageButtonLabel = this.$t('user.contact_me_page.contact_form.contact_form_button')
      return sendMessageButtonLabel.toUpperCase()
    }
  },
  mounted () {},
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
      const contactMeApi = '/api/contact-me'
      await this.form.post(contactMeApi)
      this.form.full_name = null
      this.form.email = null
      this.form.privacy_policy = null
    }
  },
  metaInfo () {
    return { title: this.$t('user.contact_me_page.page_title') }
  }
}
</script>
