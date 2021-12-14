<template>
  <div class="lv-con-sect-categories">
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION START -->
    <div v-for="category in displayAllBlogCategoriesAndSubcategories" :key="category.id" class="card" style="width: 20rem;">
      <div class="card-body">
        <h5 class="card-title">
          {{ category.blog_category_title }}
        </h5>
      </div>
      <router-link :to="{ path: category.blog_category_path }">
        <img :src="category.blog_image_card_url" class="d-block w-100" width="400" height="300" alt="...">
      </router-link>
      <div class="card-body">
        <p class="card-text">
          {{ category.blog_category_short_description }}
        </p>
      </div>
      <div class="card-body">
        <a v-for="subcategory in category.blog_subcategories" :key="subcategory.id" :href="subcategory.blog_subcategory_path">
          {{ subcategory.blog_subcategory_title }}
        </a>
      </div>
    </div>
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION END -->
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
  name: 'MainCategories',
  components: {},
  data: function () {
    return {}
  },
  computed: {
    ...mapGetters({
      allBlogCategoriesAndSubcategories: 'blog/allBlogCategoriesAndSubcategories'
    }),
    displayAllBlogCategoriesAndSubcategories () {
      return this.allBlogCategoriesAndSubcategories.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.allBlogCategoriesAndSubcategories.http_response_code
    }
  },
  created () {
    this.fetchBlogCategoriesAndSubcategories()
  },
  mounted () {},
  methods: {
    ...mapActions({
      fetchBlogCategoriesAndSubcategories: 'blog/fetchBlogCategoriesAndSubcategories'
    })
  }
}
</script>
