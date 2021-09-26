<template>
  <div class="container lv-con-sect-categories">
    <!-- MAIN CATEGORIES: WRITTEN ARTICLES, AUDIO AND VIDEO, SECTION START -->
    <div v-for="category in displayBlogMainCategories"
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
          {{ category.blog_category_description }}
        </p>
      </div>
      <div class="card-body">
        <a v-for="subcategory in subcategories"
           :key="subcategory.id"
           :href="subcategory.url"
        >
          {{ subcategory.name }}
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
      subcategories: [
        {
          id: 1,
          url: 'blog',
          name: 'Subcategorie 1'
        },
        {
          id: 2,
          url: 'blog',
          name: 'Subcategorie 2'
        },
        {
          id: 3,
          url: 'blog',
          name: 'Subcategorie 3'
        }
      ],
      displayBlogMainCategories: null
    }
  },
  computed: {},
  mounted () {
    this.getBlogMainCategories()
  },
  methods: {
    getBlogMainCategories: function () {
      const url = window.location.origin
      const blogMainCategoriesApi = url + '/api/blog-configuration/categories'
      axios
        .get(blogMainCategoriesApi)
        .then(response => {
          console.log('>>>>> Blog Main Categories Api Data', response.data)
          this.displayBlogMainCategories = response.data.records
        })
    }
  }
}
</script>
