<template>
  <div class="lv-pg-admin-user-blog">
    <div class="lv-pg-admin-user-blog-header">
      <h1>{{ $t('admin.blog_page.page_title') }}</h1>
    </div>
    <div class="lv-pg-admin-user-blog-body">
      <div class="my-3">
        <ul id="myTab" class="nav nav-tabs">
          <li class="nav-item">
            <a href="#blog_categories" class="nav-link active" data-bs-toggle="tab">{{ $t('admin.blog_page.tab_labels.first') }}</a>
          </li>
          <li class="nav-item">
            <a href="#blog_subcategories" class="nav-link" data-bs-toggle="tab">{{ $t('admin.blog_page.tab_labels.second') }}</a>
          </li>
          <li class="nav-item">
            <a href="#blog_articles" class="nav-link" data-bs-toggle="tab">{{ $t('admin.blog_page.tab_labels.third') }}</a>
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
                <admin-blog-subcategories
                  :blog-categories-list="blogCategoriesList"
                  @blog-subcategories="getBlogSubcategoriesListFromChild"
                />
              </div>
            </div>
          </div>
          <div id="blog_articles" class="tab-pane fade show">
            <div class="card">
              <div class="card-body">
                <admin-blog-articles
                  :blog-categories-list="blogCategoriesList"
                  :blog-subcategories-list="blogSubcategoriesList"
                />
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
import AdminBlogArticles from './articles/index.vue'

Vue.use(Vuex)

export default {
  name: 'AdminUserBlog',
  components: {
    AdminBlogCategories,
    AdminBlogSubcategories,
    AdminBlogArticles
  },
  middleware: 'auth',
  data: function () {
    return {
      blogCategoriesList: [],
      blogSubcategoriesList: []
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  methods: {
    getBlogCategoriesListFromChild (value) {
      this.blogCategoriesList = value
    },
    getBlogSubcategoriesListFromChild (value) {
      this.blogSubcategoriesList = value
    }
  },
  metaInfo () {
    return { title: 'Admin - ' + this.$t('admin.blog_page.page_title') }
  }
}
</script>
