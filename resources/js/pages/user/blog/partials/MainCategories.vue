<template>
  <div class="container lv-con-sect-categories">
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION START -->
    <div v-for="category in displayAllBlogCategoriesAndSubcategories"
         :key="category.id"
         class="card"
         style="width: 20rem;"
    >
      <div class="card-body">
        <h5 class="card-title">
          {{ category.blog_category_title }}
        </h5>
      </div>
      <router-link :to="{ path: category.blog_category_path }">
        <img :src="category.blog_image_card_url" class="d-block w-100" alt="...">
      </router-link>
      <div class="card-body">
        <p class="card-text">
          {{ category.blog_category_short_description }}
        </p>
      </div>
      <div class="card-body">
        <a v-for="subcategory in category.blog_subcategories"
           :key="subcategory.id"
           :href="subcategory.blog_subcategory_slug"
        >
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
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'MainCategories',
  components: {},
  data: function () {
    return {
      displayAllBlogCategoriesAndSubcategories: null
    }
  },
  computed: {},
  mounted () {
    this.getAllBlogMainCategoriesAndSubcategories()
  },
  methods: {
    getAllBlogMainCategoriesAndSubcategories: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog-configuration/categories-and-subcategories'
      const fullApiUrl = url + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Blog Categories and Subcategories Api Data')
          this.displayAllBlogCategoriesAndSubcategories = response.data.results
        })
    }
  }
}
</script>
