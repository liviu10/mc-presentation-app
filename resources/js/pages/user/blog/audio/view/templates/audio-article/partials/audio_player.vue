<template>
  <div class="lv-pg-audio">
    <!-- LIST OF AUDIO ARTICLES, SECTION START -->
    <div class="lv-pg-audio-body">
      <div class="card">
        <div class="card-body">
          <!-- AUDIO PLAYER, SECTION START -->
          <aplayer :music="{
                     shuffle: false,
                     repeat: 'no-repeat',
                     title: blogArticleTitle,
                     artist: ' — ' + blogArticleAuthor,
                     src: '/audio/demo_file.mp3',
                     pic: '/images/pages/blog/audio_player/audio-player-img_100.webp',
                   }"
                   :audio="{
                     autoplay: false,
                     controls: true,
                     preload: 'none',
                     volume: 1
                   }"
          />
          <!-- AUDIO PLAYER, SECTION END -->
        </div>
      </div>
    </div>
    <!-- LIST OF AUDIO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Aplayer from 'vue-aplayer'

export default {
  name: 'AudioPlayerDetails',
  components: {
    Aplayer
  },
  props: {
    blogArticleTitle: {
      default: null,
      type: String
    },
    blogArticleAuthor: {
      default: null,
      type: String
    },
    blogArticleAudioPath: {
      default: null,
      type: String
    }
  }
}
</script>
