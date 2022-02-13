<template>
  <ul class="navbar-nav ms-auto">
    <li v-for="navbar_button in navbar_buttons" :key="navbar_button.id">
      <router-link :to="{ name: navbar_button.button_url }" class="nav-link">
        {{ navbar_button.button_name }}
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'NavbarButtons',
  components: {},
  data: function () {
    return {
      navbar_buttons: [
        {
          id: 1,
          button_url: 'home-page',
          button_name: this.$t('navigation_bar.main_menu.first_button')
        },
        {
          id: 2,
          button_url: 'schedule-appointment',
          button_name: this.$t('navigation_bar.main_menu.second_button')
        },
        {
          id: 3,
          button_url: 'blog',
          button_name: this.$t('navigation_bar.main_menu.third_button')
        },
        {
          id: 4,
          button_url: 'about-me',
          button_name: this.$t('navigation_bar.main_menu.forth_button')
        },
        {
          id: 5,
          button_url: 'contact-me',
          button_name: this.$t('navigation_bar.main_menu.fifth_button')
        },
        {
          id: 6,
          button_url: 'user.auth.login',
          button_name: this.$t('navigation_bar.main_menu.sixth_button')
        }
      ]
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
