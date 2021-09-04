<template>
  <div class="container-footer-menu-button">
    <p v-for="footer_button in footer_buttons" :key="footer_button.id">
      <router-link :to="{ name: footer_button.button_url }">
        {{ footer_button.button_name }}
      </router-link>
    </p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

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
  computed: mapGetters({})
}
</script>
