<template>
  <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex justify-content-start align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <country-flag :country="locales[locale].lang_code" size="small" />
      {{ locales[locale].lang_code }}
      <span class="ms-1 fst-italic">({{ locales[locale].lang_name }})</span>
    </a>
    <ul class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
      <li><a class="dropdown-item d-flex justify-content-start align-items-center dropdown-locale" href="" /></li>
      <li>
        <a v-for="(value, key) in locales" :key="key" class="dropdown-item d-flex justify-content-start align-items-center" href="#" @click.prevent="setLocale(key)">
          <country-flag :country="value.lang_code" size="normal" />
          {{ value.lang_code }} <span class="ms-1 fst-italic"> ({{ value.lang_name }}) </span>
        </a>
      </li>
    </ul>
  </li>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'
import CountryFlag from 'vue-country-flag'
export default {
  components: {
    CountryFlag
  },
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),
  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)
        this.$store.dispatch('lang/setLocale', { locale })
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
          & .dropdown-locale {
            margin-bottom: -0.1875rem !important;
          }
        }
      }
    }
  }
</style>
