<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN CREATE NEW BLOG ARTICLES</h1>
        </div>
        <div class="lv-pg-admin-body">
          <p class="lead text-center">
            Înainte de a începe să scrii articolul, te rog să alegi categoria şi apoi subcategoria din care doreşti să facă parte acesta
          </p>
          <div class="lv-pg-admin-body-blog-category">
            <p class="lead text-center">
              Category
            </p>
            <div class="lv-pg-admin-body-blog-category-options">
              <button v-for="category in displayAllBlogCategories" :key="category.id"
                      type="button"
                      class="btn btn-primary"
                      @click="displayBlogSubcategories(category.id, category.blog_category_title)"
              >
                {{ category.blog_category_title }}
              </button>
            </div>
          </div>
          <form @submit.prevent="createNewBlogArticle" @keydown="form.onKeydown($event)">
            <div class="lv-pg-admin-body-subcategory" :hidden="hideBlogSubcategoryList">
              <div class="col col-12 my-3">
                <p class="lead text-center">
                  Subcategory
                </p>
                <select id="blog_subcategory_id"
                        v-model="form.blog_subcategory_id"
                        class="form-select"
                        :class="{ 'is-invalid': form.errors.has('blog_subcategory_id') }"
                        name="blog_subcategory_id"
                        aria-label="Default select example"
                >
                  <optgroup v-for="item in displayAllBlogSubcategories"
                            :key="item.id"
                            label="Category"
                  >
                    <option :value="item.id">
                      {{ item.blog_subcategory_title }}
                    </option>
                  </optgroup>
                </select>
              </div>
              <div class="col col-12 my-3">
                <label class="col-form-label">
                  Subcategory title
                </label>
                <input id="blog_subcategory_title"
                       v-model="form.blog_subcategory_title"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('blog_subcategory_title') }"
                       class="form-control"
                       name="blog_subcategory_title"
                >
                <has-error :form="form" field="blog_subcategory_title" />
              </div>
            </div>
          </form>

          <!-- <form @submit.prevent="createNewBlogArticle" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Subcategory title
              </label>
              <input id="blog_subcategory_title"
                     v-model="form.blog_subcategory_title"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_subcategory_title') }"
                     class="form-control"
                     name="blog_subcategory_title"
              >
              <has-error :form="form" field="blog_subcategory_title" />
            </div>
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Subcategory description
              </label>
              <textarea id="blog_subcategory_short_description"
                        v-model="form.blog_subcategory_short_description"
                        type="text"
                        class="form-control"
                        name="blog_subcategory_short_description"
                        rows="8"
                        style="resize:none"
              />
            </div>
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Activate blog subcategory?
              </label>
              <select id="blog_subcategory_is_active"
                      v-model="form.blog_subcategory_is_active"
                      class="form-select"
                      :class="{ 'is-invalid': form.errors.has('blog_subcategory_is_active') }"
                      name="blog_subcategory_is_active"
                      aria-label="Default select example"
              >
                <option value="1">
                  Yes
                </option>
                <option value="2">
                  No
                </option>
              </select>
              <has-error :form="form" field="blog_subcategory_is_active" />
            </div>
            <div class="modal-buttons">
              <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save
              </button>
            </div>
          </form> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
// import Swal from 'sweetalert2/dist/sweetalert2.js'
import Form from 'vform'
// import { VueEditor } from 'vue2-editor'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogArticlesNew',
  components: {
    // VueEditor
  },
  middleware: 'auth',
  data () {
    return {
      form: new Form({
        blog_subcategory_id: ''
      }),
      hideBlogSubcategoryList: false
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      blogCategories: 'blog/blogCategories',
      blogSubcategories: 'blog/blogSubcategories'
    }),
    displayAllBlogCategories () {
      return this.blogCategories.records
    },
    displayAllBlogSubcategories () {
      return this.blogSubcategories.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.blogCategories.http_response_code
    },
    displayLocationUrl () {
      return window.location.origin
    }
  },
  created () {
    this.fetchBlogCategories()
    this.fetchBlogSubcategories()
  },
  methods: {
    ...mapActions({
      fetchBlogCategories: 'blog/fetchBlogCategories',
      fetchBlogSubcategories: 'blog/fetchBlogSubcategories'
    })
  },
  metaInfo () {
    return { title: 'Admin - User New Blog Article' }
  }
}
</script>
<style lang="scss">
.lv-pg-admin {
    &-body {
        &-blog-category {
            &-options {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
            }
        }
    }
}
</style>
