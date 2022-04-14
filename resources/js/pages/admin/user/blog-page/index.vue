<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>USER BLOG</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#blog_categories" class="nav-link active" data-bs-toggle="tab">Blog categories</a>
              </li>
              <li class="nav-item">
                <a href="#blog_subcategories" class="nav-link" data-bs-toggle="tab">Blog subcategories</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="blog_categories" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <admin-blog-categories @blog-categories="getBlogCategoriesListFromChild" />
                  </div>
                </div>
              </div>
              <div id="blog_subcategories" class="tab-pane fade show">
                <div class="card">
                  <div class="card-body">
                    <admin-blog-subcategories :blog-categories-list="blogCategoriesList" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import AdminBlogCategories from './categories/index.vue'
import AdminBlogSubcategories from './subcategories/index.vue'

Vue.use(Vuex)

export default {
  name: 'AdminUserBlog',
  components: {
    AdminBlogCategories,
    AdminBlogSubcategories
  },
  middleware: 'auth',
  data: function () {
    return {
      blogCategoriesList: []
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  methods: {
    getBlogCategoriesListFromChild (value) {
      this.blogCategoriesList = JSON.parse(JSON.stringify(value))
    }
  },
  metaInfo () {
    return { title: 'Admin - User Blog' }
  }
}
</script>
