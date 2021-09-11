<template>
  <div class="container-footer-menu-button">
    <p v-for="footer_button in footer_buttons" :key="footer_button.id">
      <router-link :to="{ name: footer_button.button_url }">
        {{ footer_button.button_name }}
      </router-link>
    </p>
    <form @submit.prevent="unsubscribe">
      <button type="submit">
        UBSUBSCRIBE
      </button>
    </form>
  </div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'

export default {
  name: 'FooterMenu',
  components: {},
  data: function () {
    return {
      footer_buttons: [
        {
          id: 1,
          button_url: 'terms-and-conditions',
          button_name: this.$t('footer.footer_menu.first_button')
        }
      ]
    }
  },
  computed: {},
  methods: {
    async unsubscribe () {
      // const newsletterApi = '/api'
      // const { data } = await this.form.post(newsletterApi)
      // console.log('>>>>>>', this.form)
      Swal.fire({
        title: this.$t('user.home_page.newsletter.swal_unsubscribe.title'),
        text: this.$t('user.home_page.newsletter.swal_unsubscribe.message'),
        input: 'email',
        inputPlaceholder: this.$t('user.home_page.newsletter.swal_unsubscribe.input_email_address'),
        showCancelButton: true,
        confirmButtonText: this.$t('user.home_page.newsletter.swal_unsubscribe.confirm_button')
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: this.$t('user.home_page.newsletter.swal_unsubscribe.after_confirm_title'),
            confirmButtonText: this.$t('user.home_page.newsletter.swal_unsubscribe.after_confirm_button')
          })
        }
      })
    }
  }
}
</script>
