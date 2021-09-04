<template>
  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <router-link :to="{ name: 'home-page' }" class="nav-link">
        {{ $t('navigation_bar.main_menu.first_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'schedule-appointment' }" class="nav-link">
        {{ $t('navigation_bar.main_menu.second_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'blog' }" class="nav-link">
        {{ $t('navigation_bar.main_menu.third_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'about-me' }" class="nav-link">
        {{ $t('navigation_bar.main_menu.forth_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'contact-me' }" class="nav-link">
        {{ $t('navigation_bar.main_menu.fifth_button') }}
      </router-link>
    </li>
  </ul>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'NavbarButtons',
  components: {},
  computed: mapGetters({
    user: 'auth/user'
  })
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
