<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="display-tooltip display-tooltip--contact-title display-tooltip--hide">
        1
        <span class="display-tooltip-text">
          <h1>Title:</h1>
          <p>
            <ul>
              <li>
                De gasit un titlu potrivit pentru pagina de contact.
              </li>
            </ul>
          </p>
        </span>
      </div>
      <div class="display-tooltip display-tooltip--contact-description display-tooltip--hide">
        2
        <span class="display-tooltip-text">
          <h1>Description:</h1>
          <p>
            <ul>
              <li>
                De gasit o scurta descriere a paginii de contact (maxim 50 de cuvinte).
              </li>
            </ul>
          </p>
        </span>
      </div>
      <div class="container lv-con-pg-contact-form">
        <!-- PICTURE PAGE, SECTION START -->
        <div class="card" style="width: 18rem;">
          <img src="images/contact/dance-question-mark.jpg" class="card-img-top" alt="...">
        </div>
        <!-- PICTURE PAGE, SECTION END -->

        <div class="display-tooltip display-tooltip--contact-field-name display-tooltip--hide">
          3
          <span class="display-tooltip-text">
            <h1>Camp Nume si Prenume:</h1>
            <p>
              <ul>
                <li>
                  Daca este cazul putem schimba textul "Numele si Prenumele tau" care se vede in interiorul casetei de inserare.
                </li>
              </ul>
            </p>
          </span>
        </div>
        <div class="display-tooltip display-tooltip--contact-field-email display-tooltip--hide">
          4
          <span class="display-tooltip-text">
            <h1>Camp Adresa e-mail:</h1>
            <p>
              <ul>
                <li>
                  Daca este cazul putem schimba textul "Adresa ta de e-mail" care se vede in interiorul casetei de inserare.
                </li>
              </ul>
            </p>
          </span>
        </div>
        <div class="display-tooltip display-tooltip--contact-field-message display-tooltip--hide">
          5
          <span class="display-tooltip-text">
            <h1>Camp Mesaj:</h1>
            <p>
              <ul>
                <li>
                  Daca este cazul putem schimba textul "Lasa-mi un mesaj" care se vede in interiorul casetei de inserare.
                </li>
              </ul>
            </p>
          </span>
        </div>

        <!-- CONTACT FORM, SECTION START -->
        <div class="container-contact-form">
          <div class="container-contact-form-head">
            <h1>Lorem, ipsum dolor.</h1>
            <p class="lead">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum distinctio amet eos beatae culpa autem, quis consequatur alias adipisci ipsam.
            </p>
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
  layout: '',
  middleware: '',
  props: {},
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
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {
    showMore () {
      this.$router.push({ path: '/blog/article' })
    },
    async subscribe () {
      const contactMeApi = '/api/contact-me'
      const { data } = await this.form.post(contactMeApi)
      console.log('>>>>>> Contact Me Api URL: ', data)
    }
  },
  metaInfo () {
    return { title: this.$t('user.contact_me_page.page_title') }
  }
}
</script>
