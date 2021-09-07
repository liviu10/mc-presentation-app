<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-container-contact-form">
        <!-- PICTURE PAGE, SECTION START -->
        <div class="card" style="width: 18rem;">
          <img src="images/contact/dance-question-mark.jpg" class="card-img-top" alt="...">
        </div>
        <!-- PICTURE PAGE, SECTION END -->

        <!-- CONTACT FORM, SECTION START -->
        <div class="container-contact-form">
          <div class="container-contact-head">
            <h1>Lorem, ipsum dolor.</h1>
            <p class="lead">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum distinctio amet eos beatae culpa autem, quis consequatur alias adipisci ipsam.
            </p>
          </div>
          <div class="container-contact-main">
            <form @submit.prevent="subscribe" @keydown="form.onKeydown($event)">
              <alert-success :form="form" :message="message_success" />
              <!-- FULL NAME, SECTION START -->
              <div class="mb-4">
                <input id="full_name"
                       v-model="form.full_name"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('full_name') }"
                       class="form-control"
                       placeholder="Numele si Prenumele tau"
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
                       placeholder="Adresa ta de e-mail"
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
                          placeholder="Lasa-mi un mesaj"
                          name="message"
                />
                <has-error :form="form" field="message" />
              </div>
              <!-- MESSAGE, SECTION END -->
              <!-- PRIVACY POLICY, SECTION START -->
              <div class="my-4 form-check">
                <input id="privacy_policy"
                       v-model="form.privacy_policy"
                       type="checkbox"
                       :class="{ 'is-invalid': form.errors.has('privacy_policy') }"
                       class="form-check-input"
                       name="privacy_policy"
                >
                <label class="form-check-label lead" for="flexCheckChecked">
                  Sunt de acord cu
                  <router-link :to="{ name: 'home-page' }">termenii si conditiile</router-link>
                </label>
                <has-error :form="form" field="privacy_policy" />
              </div>
              <!-- PRIVACY POLICY, SECTION END -->
              <button type="submit" class="btn btn-primary">
                TRIMITE MESAJUL
              </button>
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
  data: function () {
    return {
      message_success: this.$t('user.contact-me-page.general.message_sent'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  computed: {},
  methods: {
    async subscribe () {
      const contactMeApi = '/api/contact-me'
      const { data } = await this.form.post(contactMeApi)
      console.log('>>>>>> Contact Me Api URL: ', data)
    }
  }
}
</script>
