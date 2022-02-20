<template>
  <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION START -->
  <li v-if="user" class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark d-flex justify-content-start align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img :src="user.photo_url" class="rounded-circle profile-photo me-1">
      {{ user.nickname }}
    </a>
    <ul class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
      <li>
        <a class="dropdown-item ps-2 py-2 dropdown-profile" href="" />
      </li>
      <li>
        <router-link :to="{ name: '' }" class="dropdown-item ps-2 py-2">
          <fa icon="book-open" fixed-width />
          {{ $t('navigation_bar.sub_menu.first_button') }}
        </router-link>
      </li>
      <div class="dropdown-divider my-0" />
      <li>
        <a href="#" class="dropdown-item ps-2 py-2" @click.prevent="logout">
          <fa icon="sign-out-alt" fixed-width />
          {{ $t('navigation_bar.sub_menu.second_button') }}
        </a>
      </li>
    </ul>
  </li>
  <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION END -->
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'NavbarSubMenuButtons',
  components: {},
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to home page.
      this.$router.push({ name: 'home-page' })
    }
  }
}
</script>
<style lang="scss">
  .navbar {
    &-nav {
      & .nav-item {
        & .dropdown-menu {
          & .dropdown-profile {
            margin-bottom: -0.25rem !important;
          }
        }
      }
    }
  }
</style>
