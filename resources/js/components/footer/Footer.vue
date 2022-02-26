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
          <p>
            <fa icon="at" fixed-width />
            <a href="mailto:contact@madalinacorina.ro" class="email">
              contact@madalinacorina.ro
            </a>
          </p>
          <!-- FOOTER MENU EMAIL, SECTION END -->

          <!-- FOOTER MENU SOCIAL MEDIA, SECTION START -->
          <p>
            <span>{{ $t('user.general_settings.social_menu.title') }}</span>
            <a href="https://www.facebook.com/groups/269560668238590/?ref=share" class="btn btn-primary" target="_blank" :title="$t('user.general_settings.social_menu.facebook')" rel="noreferrer">
              <fa :icon="['fab', 'facebook']" fixed-width />
            </a>
            <!-- <a href="" class="btn btn-primary" target="_blank" :title="$t('user.general_settings.social_menu.instagram')" rel="noreferrer">
              <fa :icon="['fab', 'instagram']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.general_settings.social_menu.youtube')" rel="noreferrer">
              <fa :icon="['fab', 'youtube']" fixed-width />
            </a> -->
          </p>
          <!-- FOOTER MENU, SECTION START -->
        </div>
      </div>
      <div class="container-footer-copyright">
        <p>
          Copyright &#169; {{ new Date().getFullYear() }}
          <router-link :to="{ name: 'home-page' }">
            <span>Mădălina Corina Marius</span>
          </router-link>
          {{ $t('footer.copyright.info') }}
        </p>
        <p>
          Designed by
          <a href="https://github.com/liviu10" target="_blank" rel="noreferrer">Liviu Voica</a>
        </p>
      </div>
    </div>
  </footer>
<!-- FOOTER, SECTION END -->
</template>

<script>
import FooterMenu from './subcomponents/FooterMenu.vue'

export default {
  components: {
    FooterMenu
  }
}
</script>
