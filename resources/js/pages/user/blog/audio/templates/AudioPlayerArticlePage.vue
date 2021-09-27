<template>
  <!-- AUDIO PAGE TEMPLATE, SECTION START -->
  <div class="lv-con-pg-audio-list">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          <router-link :to="{ name: 'audio-view-index' }">
            Article Title
          </router-link>
          <span>(15 min audio)</span>
          <p>
            Published on:
            <span>Septembrie 11 2021</span>
          </p>
        </h5>
        <p class="card-text">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.
        </p>
        <!-- AUDIO PLAYER, SECTION START -->
        <audio-player />
        <!-- AUDIO PLAYER, SECTION END -->
      </div>
    </div>
  </div>
  <!-- AUDIO PAGE TEMPLATE, SECTION END -->
</template>

<script>
import AudioPlayer from '~/pages/user/blog/partials/AudioPlayer.vue'

export default {
  name: 'AudioPage',
  components: {
    AudioPlayer
  },
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {}
  },
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {},
  metaInfo () {}
}
</script>
