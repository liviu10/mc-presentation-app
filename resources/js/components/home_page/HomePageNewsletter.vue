<template>
  <div class="container lv-con-sect-newsletter">
    <form @submit.prevent="subscribe" @keydown="form.onKeydown($event)">
      <div class="row">
        <!-- FULL NAME, SECTION START -->
        <div class="col col-5">
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
        <div class="col col-5">
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
        <div class="col col-2">
          <button type="submit" class="btn btn-success">
            ABONEAZA-TE!
          </button>
        </div>
      </div>
      <div class="row">
        <!-- PRIVACY POLICY, SECTION START -->
        <div class="form-check">
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
  computed: {},
  methods: {
    async subscribe () {
      const newsletterApi = '/api'
      const { data } = await this.form.post(newsletterApi)
      console.log('>>>>>> Newsletter Api URL: ', data)
      Swal.fire({
        title: this.$t('user.home-page.general.swal_newsletter.title'),
        text: this.$t('user.home-page.general.swal_newsletter.message'),
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
