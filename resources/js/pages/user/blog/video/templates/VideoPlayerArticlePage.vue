<template>
  <!-- VIDEO PAGE TEMPLATE, SECTION START -->
  <!-- TODO: Prepare a template for displaying a single video article from the database -->
  <div />
  <!-- VIDEO PAGE TEMPLATE, SECTION END -->
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'VideoPageArticle',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      notifyCode: null,
      notifyMessage: null,
      showVideoArticle: null
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {
    this.displaySingleVideoArticle()
  },
  methods: {
    displaySingleVideoArticle: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/articles/'
      const urlParameter = this.$route.params.id
      const fullApiUrl = url + apiEndPoint + urlParameter
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display a single video blog article')
          if (response.data.results.length === 0) {
            this.notifyCode = response.data.notify_code
            this.notifyMessage = response.data.user_message
          } else {
            this.showVideoArticle = response.data.results
          }
        })
    }
  },
  metaInfo () {}
}
</script>
