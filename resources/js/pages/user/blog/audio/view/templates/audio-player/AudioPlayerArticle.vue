<template>
  <!-- AUDIO PAGE TEMPLATE, SECTION START -->
  <!-- TODO: Prepare a template for displaying a single audio article from the database -->
  <div />
  <!-- AUDIO PAGE TEMPLATE, SECTION END -->
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'AudioPlayerArticle',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      showAudioArticle: null
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {
    this.displaySingleAudioArticle()
  },
  methods: {
    displaySingleAudioArticle: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a single audio blog article')
          if (response.data.results.length === 0) {
            this.notifyCode = response.data.notify_code
            this.notifyMessage = response.data.user_message
          } else {
            this.showAudioArticle = response.data.results
          }
        })
    }
  },
  metaInfo () {}
}
</script>
