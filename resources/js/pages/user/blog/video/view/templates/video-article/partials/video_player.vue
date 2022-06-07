<template>
  <div class="lv-pg-video">
    <!-- LIST OF VIDEO ARTICLES, SECTION START -->
    <div class="lv-pg-video-body">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-12">
            <!-- VIDEO PLAYER, SECTION START -->
            <iframe
              width="720"
              height="480"
              :src="blogArticleVideoPath"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            />
            <!-- VIDEO PLAYER, SECTION END -->
          </div>
        </div>
      </div>
    </div>
    <!-- LIST OF VIDEO ARTICLES, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'VideoListArticles',
  props: {
    blogArticleVideoPath: {
      default: null,
      type: String
    }
  },
  data: function () {
    return {}
  },
  computed: {
    ...mapGetters({
      listOfVideoArticles: 'blog/listOfVideoArticles'
    }),
    displayAllVideoBlogArticles () {
      return this.listOfVideoArticles.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfVideoArticles.http_response_code
    }
  },
  created () {
    this.fetchListOfVideoArticles()
  },
  methods: {
    ...mapActions({
      fetchListOfVideoArticles: 'blog/fetchListOfVideoArticles'
    })
  }
}
</script>
