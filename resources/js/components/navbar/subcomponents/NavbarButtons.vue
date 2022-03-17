<template>
  <ul v-if="!user" class="navbar-nav ms-auto">
    <li>
      <router-link :to="{ name: 'home-page' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.first_button') }}
      </router-link>
    </li>
    <li>
      <router-link :to="{ name: 'blog' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.second_button') }}
      </router-link>
    </li>
    <li>
      <router-link :to="{ name: 'schedule-appointment' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.third_button') }}
      </router-link>
    </li>
    <li>
      <router-link :to="{ name: 'about-me' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.forth_button') }}
      </router-link>
    </li>
    <li>
      <router-link :to="{ name: 'contact-me' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.fifth_button') }}
      </router-link>
    </li>
    <li>
      <router-link :to="{ name: 'user.auth.login' }" class="nav-link">
        {{ $t('user.navigation_bar.main_menu.sixth_button') }}
      </router-link>
    </li>
  </ul>
  <ul v-else-if="user && user.user_role_type_id === 1" class="navbar-nav ms-auto">
    <li v-if="checkUrlPathName() === false">
      <router-link :to="{ name: 'admin-home-page' }" class="nav-link">
        {{ $t('user.navigation_bar.auth_main_menu.second_button') }}
      </router-link>
    </li>
    <li v-if="checkUrlPathName() === true">
      <router-link :to="{ name: 'home-page' }" class="nav-link">
        {{ $t('user.navigation_bar.auth_main_menu.first_button') }}
      </router-link>
    </li>
  </ul>
  <ul v-else class="navbar-nav ms-auto" />
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'NavbarButtons',
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    checkUrlPathName () {
      const adminHomePageUrl = '/admin/home'
      const getUrlPathName = this.$route.fullPath

      return getUrlPathName.includes(adminHomePageUrl)
    }
  }
}
</script>
<style lang="scss">
  .navbar {
    &-nav {
      & .nav-item {
        & .dropdown-menu {
          & .dropdown-item {
            &:first-child {
              margin-bottom: 0.0625rem;
            }
          }
        }
      }
    }
  }
</style>
