<template>
  <ul v-if="user" class="navbar-nav">
    <li class="nav-item">
      <router-link :to="{ name: 'home' }" class="nav-link">
        {{ $t('navigation_bar.first_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'schedule-appointment' }" class="nav-link">
        {{ $t('navigation_bar.second_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'blog' }" class="nav-link">
        {{ $t('navigation_bar.third_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'about-me' }" class="nav-link">
        {{ $t('navigation_bar.forth_button') }}
      </router-link>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'contact-me' }" class="nav-link">
        {{ $t('navigation_bar.fifth_button') }}
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
