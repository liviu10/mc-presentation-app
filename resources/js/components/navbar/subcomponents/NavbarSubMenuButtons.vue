<template>
  <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION START -->
  <li v-if="user" class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark d-flex justify-content-start align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img :src="user.photo_url" class="rounded-circle profile-photo me-1">
      {{ user.nickname }}
    </a>
    <ul v-if="user.user_role_type_id === 1" class="dropdown-menu pb-0" aria-labelledby="navbarDropdown">
      <li>
        <a class="dropdown-item p-2 dropdown-profile" href="" />
      </li>
      <li>
        <router-link :to="{ name: 'admin-blog-page' }" class="dropdown-item p-2">
          <fa :icon="['fab', 'blogger-b']" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.first_button') }}
        </router-link>
        <router-link :to="{ name: 'admin-contact-me-settings-page' }" class="dropdown-item p-2">
          <fa icon="comment" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.second_button') }}
        </router-link>
        <router-link :to="{ name: 'admin-newsletter-settings-page' }" class="dropdown-item p-2">
          <fa icon="newspaper" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.third_button') }}
        </router-link>
      </li>
      <div class="dropdown-divider my-0" />
      <li>
        <router-link :to="{ name: 'admin-application-settings-page' }" class="dropdown-item p-2">
          <fa icon="cog" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.forth_button') }}
        </router-link>
        <router-link :to="{ name: 'admin-documentation-page' }" class="dropdown-item p-2">
          <fa icon="book" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.fifth_button') }}
        </router-link>
      </li>
      <div class="dropdown-divider my-0" />
      <li>
        <router-link :to="{ name: 'admin-profile-settings-page' }" class="dropdown-item p-2">
          <fa icon="address-card" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.sixth_button') }}
        </router-link>
      </li>
      <li>
        <a href="#" class="dropdown-item p-2" @click.prevent="logout">
          <fa icon="sign-out-alt" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.seventh_button') }}
        </a>
      </li>
    </ul>
    <ul v-else class="dropdown-menu pb-0" aria-labelledby="navbarDropdown" style="clip-path: polygon(52% 0%, 60% 15%, 100% 15%, 100% 100%, 0 100%, 0 15%, 46% 15%)">
      <li>
        <router-link :to="{ name: 'admin-profile-settings-page' }" class="dropdown-item p-2">
          <fa icon="address-card" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.sixth_button') }}
        </router-link>
      </li>
      <li>
        <a href="#" class="dropdown-item p-2" @click.prevent="logout">
          <fa icon="sign-out-alt" fixed-width />
          {{ $t('user.navigation_bar.sub_menu.seventh_button') }}
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
      const getUrlPathName = this.$route.fullPath
      const adminPageUrls = '/admin'
      if (getUrlPathName.includes(adminPageUrls) === true) {
        this.$router.push({ name: 'home-page' })
      }
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
