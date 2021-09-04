<template>
  <p>
    <span>Mă găsești și pe:</span>
    <a href="https://www.facebook.com/groups/269560668238590/?ref=share" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Facebook!">
      <fa :icon="['fab', 'facebook']" fixed-width />
    </a>
    <a href="" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Instagram!">
      <fa :icon="['fab', 'instagram']" fixed-width />
    </a>
    <a href="" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Youtube!">
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
