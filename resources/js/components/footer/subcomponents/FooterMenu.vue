<template>
  <div class="container-footer-menu-button">
    <p v-for="footer_button in footer_buttons" :key="footer_button.id">
      <router-link :to="{ name: footer_button.button_url }">
        {{ footer_button.button_name }}
      </router-link>
    </p>
    <form @submit.prevent="unsubscribe">
      <input id="email"
             v-model="form.email"
             type="email"
             :class="{ 'is-invalid': form.errors.has('email') }"
             class="form-control"
             :placeholder="$t('user.home_page.newsletter.input_email_address')"
             name="email"
      >
      <has-error :form="form" field="email" />
      <button type="submit"
              class="btn btn-success"
      >
        {{ capitalizeUnsubscribeButton }}
      </button>
    </form>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  name: 'FooterMenu',
  components: {},
  data: function () {
    return {
      form: new Form({
        email: ''
      }),
      footer_buttons: [
        {
          id: 1,
          button_url: 'terms-and-conditions',
          button_name: this.$t('footer.footer_menu.first_button')
        }
      ]
    }
  },
  computed: {
    capitalizeUnsubscribeButton () {
      const unsubscribeButtonLabel = this.$t('user.home_page.newsletter.unsubscribe_button')
      return unsubscribeButtonLabel.toUpperCase()
    }
  },
  methods: {
    async unsubscribe () {
      const newsletterApi = '/api'
      const { data } = await this.form.get(newsletterApi)
      console.log('>>>>>> ON CLICK MODAL: ', data)
    }
  }
}
</script>
