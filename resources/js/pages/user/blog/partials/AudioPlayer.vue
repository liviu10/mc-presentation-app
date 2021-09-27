<template>
  <aplayer :music="{
             shuffle: false,
             repeat: 'no-repeat',
             title: 'Song Title',
             artist: ' — ' + 'Song Artist',
             src: '/audio/demo_file.mp3',
             pic: '/images/blog/audio-player-img.jpg',
           }"
           :audio="{
             autoplay: false,
             controls: true,
             preload: 'none',
             volume: 1
           }"
  />
</template>

<script>
import Aplayer from 'vue-aplayer'

export default {
  name: 'AudioPlayer',
  components: {
    Aplayer
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
