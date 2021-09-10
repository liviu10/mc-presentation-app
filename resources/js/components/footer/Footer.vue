<template>
  <!-- FOOTER, SECTION START -->
  <footer>
    <div class="container-fluid container-footer">
      <div class="container-footer-menu">
        <!-- FOOTER MENU, SECTION START -->
        <footer-menu />
        <!-- FOOTER MENU, SECTION END -->

        <div class="container-footer-menu-contact">
          <!-- FOOTER MENU EMAIL, SECTION START -->
          <footer-menu-email />
          <!-- FOOTER MENU EMAIL, SECTION END -->

          <!-- FOOTER MENU SOCIAL MEDIA, SECTION START -->
          <footer-menu-social-media />
          <!-- FOOTER MENU, SECTION START -->
        </div>
      </div>
      <div class="container-footer-copyright">
        <p>
          Copyright &#169; 2021
          <router-link :to="{ name: 'home-page' }">
            Mădălina Corina Marius
          </router-link>
          All rights reserved
        </p>
        <p>
          Desined by
          <a href="https://github.com/liviu10">Liviu Voica</a>
        </p>
      </div>
    </div>
  </footer>
<!-- FOOTER, SECTION END -->
</template>

<script>
import { mapGetters } from 'vuex'
import FooterMenu from './subcomponents/FooterMenu.vue'
import FooterMenuEmail from './subcomponents/FooterMenuEmail.vue'
import FooterMenuSocialMedia from './subcomponents/FooterMenuSocialMedia.vue'

export default {
  components: {
    FooterMenu,
    FooterMenuEmail,
    FooterMenuSocialMedia
  },
  computed: mapGetters({})
}
</script>
