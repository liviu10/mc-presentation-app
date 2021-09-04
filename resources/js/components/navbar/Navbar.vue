<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <!-- NAVBAR BRAND SECTION START -->
      <router-link :to="{ name: 'home-page' }" class="navbar-brand">
        <img src="/images/logo/Logo-img.png" alt="">
        <p class="text-wrap">
          Lorem ipsum dolor sit amet.
        </p>
      </router-link>
      <!-- NAVBAR BRAND SECTION END -->

      <!-- NAVBAR HAMBURGER MENU SECTION START -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" />
      </button>
      <!-- NAVBAR HAMBURGER MENU SECTION END -->

      <div id="navbarSupportedContent" class="collapse navbar-collapse">
        <!-- NAVBAR MENU BUTTONS IF USER IS LOGGED IN SECTION START -->
        <navbar-buttons />
        <!-- NAVBAR MENU BUTTONS USER IS LOGGED IN SECTION END -->

        <ul class="navbar-nav">
          <!-- LANGUAGE SWITCHER SECTION START -->
          <locale-dropdown />
          <!-- LANGUAGE SWITCHER SECTION END -->

          <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN OR LOGGED OUT SECTION START -->
          <navbar-sub-menu-buttons />
          <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN OR LOGGED OUT SECTION END -->
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './subcomponents/LocaleDropdown'
import NavbarButtons from './subcomponents/NavbarButtons.vue'
import NavbarSubMenuButtons from './subcomponents/NavbarSubMenuButtons.vue'

export default {
  components: {
    LocaleDropdown,
    NavbarButtons,
    NavbarSubMenuButtons
  },
  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>
