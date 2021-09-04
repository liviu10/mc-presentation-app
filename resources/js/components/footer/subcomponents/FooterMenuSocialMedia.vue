<template>
  <p>
    <span>{{ $t('footer.social_menu.title') }}</span>
    <a href="https://www.facebook.com/groups/269560668238590/?ref=share" class="btn btn-primary btn-lg" target="_blank" :title="$t('footer.social_menu.facebook')">
      <fa :icon="['fab', 'facebook']" fixed-width />
    </a>
    <a href="" class="btn btn-primary btn-lg" target="_blank" :title="$t('footer.social_menu.instagram')">
      <fa :icon="['fab', 'instagram']" fixed-width />
    </a>
    <a href="" class="btn btn-primary btn-lg" target="_blank" :title="$t('footer.social_menu.youtube')">
      <fa :icon="['fab', 'youtube']" fixed-width />
    </a>
  </p>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'FooterMenuSocialMedia',
  components: {},
  computed: mapGetters({})
}
</script>
