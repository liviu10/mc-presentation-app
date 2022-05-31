<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN CREATE NEW BLOG ARTICLES</h1>
        </div>
        <div class="lv-pg-admin-body">
          <form @submit.prevent="publishArticle" @keydown="form.onKeydown($event)">
            <!-- BLOG SUBCATEGORY, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-subcategory">
              <label class="col-form-label">
                Select the blog subcategory for this article
                <div id="blog_subcategory_help" class="form-text mt-0">
                  You can select only one blog subcategory. Each of the three blog categories will generate its specific template for writing articles.
                </div>
              </label>
              <select id="blog_subcategory"
                      v-model="form.blog_subcategory"
                      class="form-select"
                      :class="{ 'is-invalid': form.errors.has('blog_subcategory') }"
                      name="blog_subcategory"
                      aria-label="Default select example"
              >
                <optgroup v-for="category in displayAllBlogCategoriesAndSubcategories" :key="category.id" :label="'Category: ' + category.blog_category_title">
                  <option v-for="subcategory in category.blog_subcategories" :key="subcategory.id" :value="subcategory">
                    {{ subcategory.blog_subcategory_title }}
                  </option>
                </optgroup>
              </select>
              <has-error :form="form" field="blog_subcategory" />
            </div>
            <!-- BLOG SUBCATEGORY, SECTION END -->

            <!-- BLOG ARTICLE TITLE, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-title">
              <label class="col-form-label">
                Article title
              </label>
              <div v-if="form.blog_subcategory">
                <input id="blog_article_title"
                       v-model="form.blog_article_title"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('blog_article_title') }"
                       class="form-control"
                       name="blog_article_title"
                >
                <has-error :form="form" field="blog_article_title" />
              </div>
              <div v-else>
                <p>
                  In order to write your article's title, please choose a blog subcategory!
                </p>
              </div>
            </div>
            <!-- BLOG ARTICLE TITLE, SECTION END -->

            <!-- BLOG ARTICLE SHORT DESCRIPTION, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-short-description">
              <label class="col-form-label">
                Article short description
                <div id="blog_article_short_description_help" class="form-text mt-0">
                  The blog article short description will be visible when the user will visit the list of all articles no matter the subcategory they belong to.
                </div>
              </label>
              <div v-if="form.blog_subcategory">
                <textarea id="blog_article_short_description"
                          v-model="form.blog_article_short_description"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_short_description') }"
                          class="form-control"
                          name="blog_article_short_description"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_short_description" />
              </div>
              <div v-else>
                <p>
                  In order to write your article's short description, please choose a blog subcategory!
                </p>
              </div>
            </div>
            <!-- BLOG ARTICLE SHORT DESCRIPTION, SECTION END -->

            <!-- BLOG ARTICLE MEDIA, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-media">
              <label class="col-form-label">
                Article media
                <div id="blog_article_media_url_help" class="form-text mt-0">
                  Blog article media refers to image, audio or video content that you whish to include in your article. Based on your blog subcategory selection, this section will be different
                  (eg. if you select a subcategory that belongs to Written blog articles category, you can upload a picture)
                </div>
              </label>
              <input v-if="form.blog_subcategory && form.blog_subcategory.blog_category_id === 1"
                     id="blog_article_media_url"
                     type="file"
                     :class="{ 'is-invalid': form.errors.has('blog_article_media_url') }"
                     class="form-control"
                     name="blog_article_media_url"
                     accept="image/png, image/jpeg, image/jpg"
                     @change="uploadBlogArticleImage($event)"
              >
              <input v-else-if="form.blog_subcategory && (form.blog_subcategory.blog_category_id === 2 || form.blog_subcategory.blog_category_id === 3)"
                     id="blog_article_media_url"
                     v-model="form.blog_article_media_url"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_article_media_url') }"
                     class="form-control"
                     name="blog_article_media_url"
              >
              <p v-else>
                In order to upload article's media content, please choose a blog subcategory!
              </p>
              <has-error :form="form" field="blog_article_media_url" />
            </div>
            <!-- BLOG ARTICLE MEDIA, SECTION END -->

            <!-- BLOG ARTICLE CONTENT, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-content">
              <label class="col-form-label">
                Article content
                <div id="blog_article_content_help" class="form-text mt-0">
                  An article content can have up to 5 paragraphs (called sections). Based on your blog subcategory selection, this section will be different
                  (eg. if you selected a subcategory that belongs to Written blog articles category, you can generate a maximum of 5 section for your article)
                </div>
              </label>
            </div>
            <div v-if="form.blog_subcategory && form.blog_subcategory.blog_category_id === 1">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph 1
                </label>
                <textarea id="blog_article_content_section_1"
                          v-model="form.blog_article_content.section_1"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_1') }"
                          class="form-control"
                          name="blog_article_content_section_1"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_1" />
              </div>

              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph 2
                </label>
                <textarea id="blog_article_content_section_2"
                          v-model="form.blog_article_content.section_2"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_2') }"
                          class="form-control"
                          name="blog_article_content_section_2"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_2" />
              </div>

              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph 3
                </label>
                <textarea id="blog_article_content_section_3"
                          v-model="form.blog_article_content.section_3"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_3') }"
                          class="form-control"
                          name="blog_article_content_section_3"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_3" />
              </div>

              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph 4
                </label>
                <textarea id="blog_article_content_section_4"
                          v-model="form.blog_article_content.section_4"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_4') }"
                          class="form-control"
                          name="blog_article_content_section_4"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_4" />
              </div>

              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph 5
                </label>
                <textarea id="blog_article_content_section_5"
                          v-model="form.blog_article_content.section_5"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_5') }"
                          class="form-control"
                          name="blog_article_content_section_5"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_5" />
              </div>
            </div>
            <div v-else-if="form.blog_subcategory && (form.blog_subcategory.blog_category_id === 2 || form.blog_subcategory.blog_category_id === 3)">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Paragraph
                </label>
                <textarea id="blog_article_content_section_1"
                          v-model="form.blog_article_content.section_1"
                          type="text"
                          :class="{ 'is-invalid': form.errors.has('blog_article_content.section_1') }"
                          class="form-control"
                          name="blog_article_content_section_1"
                          rows="8"
                          style="resize:none"
                />
                <has-error :form="form" field="blog_article_content_section_1" />
              </div>
            </div>
            <div v-else>
              <p>
                In order to write your article's content, please choose a blog subcategory!
              </p>
            </div>
            <!-- BLOG ARTICLE CONTENT, SECTION END -->

            <!-- BLOG ARTICLE IS ACTIVE, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-subcategory">
              <label class="col-form-label">
                Activate this blog article?
                <div id="blog_article_is_active_help" class="form-text mt-0">
                  You can choose weather or not to activate the blog article. If you select 'No', the article will not be visible on the website.
                </div>
              </label>
              <div v-if="form.blog_subcategory">
                <select id="blog_article_is_active"
                        v-model="form.blog_article_is_active"
                        class="form-select"
                        :class="{ 'is-invalid': form.errors.has('blog_article_is_active') }"
                        name="blog_article_is_active"
                        aria-label="Default select example"
                >
                  <option value="0">
                    No, do not activate it!
                  </option>
                  <option value="1">
                    Yes, activate it!
                  </option>
                </select>
                <has-error :form="form" field="blog_article_is_active" />
              </div>
              <div v-else>
                <p>
                  In order to activate this article, please choose a blog subcategory!
                </p>
              </div>
            </div>
            <!-- BLOG ARTICLE IS ACTIVE, SECTION END -->
          </form>

          <div class="lv-pg-admin-body-buttons">
            <button type="button" class="btn btn-secondary" @click="cancelNewArticle()">
              Cancel
            </button>
            <button v-if="form.blog_article_is_active" type="submit" class="btn btn-success" @click="publishArticle()">
              <span v-if="form.blog_article_is_active === '0'">
                Save article as draft
              </span>
              <span v-if="form.blog_article_is_active === '1'">
                Publish article
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import Form from 'vform'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogArticlesNew',
  middleware: 'auth',
  data () {
    return {
      form: new Form({
        blog_subcategory: null,
        blog_article_title: '',
        blog_article_short_description: '',
        blog_article_media_url: '',
        blog_article_content: {
          section_1: '',
          section_2: '',
          section_3: '',
          section_4: '',
          section_5: ''
        },
        blog_article_is_active: false
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      allBlogCategoriesAndSubcategories: 'blog/allBlogCategoriesAndSubcategories',
      blogSubcategories: 'blog/blogSubcategories'
    }),
    displayAllBlogCategoriesAndSubcategories () {
      return this.allBlogCategoriesAndSubcategories.records
    },
    displayAllBlogSubcategories () {
      return this.blogSubcategories.records
    },
    displayLocationUrl () {
      return window.location.origin
    }
  },
  created () {
    this.fetchBlogCategoriesAndSubcategories()
    this.fetchBlogSubcategories()
  },
  methods: {
    ...mapActions({
      fetchBlogCategoriesAndSubcategories: 'blog/fetchBlogCategoriesAndSubcategories',
      fetchBlogSubcategories: 'blog/fetchBlogSubcategories'
    }),
    cancelNewArticle () {
      console.log('> form: ', this.form)
      if (Object.values(this.form).every(formProperty => formProperty !== null || formProperty !== '')) {
        Swal.fire({
          title: 'Unsaved changes!',
          text: 'You have started creating a new blog article but you did not finished it! Close this window and save the changes!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, leave the page!',
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false
        }).then(result => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'admin-user-blog-page' })
            this.form.blog_subcategory = null
            this.form.blog_article_title = ''
            this.form.blog_article_short_description = ''
            this.form.blog_article_media_url = ''
            this.form.section_1 = ''
            this.form.section_2 = ''
            this.form.section_3 = ''
            this.form.section_4 = ''
            this.form.section_5 = ''
            this.form.blog_article_is_active = false
          }
        })
      }
    },
    async publishArticle () {
      const url = window.location.origin
      const apiEndPoint = '/api/admin/system/blog/create-article'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          blog_subcategory: this.form.blog_subcategory.id,
          blog_article_title: this.form.blog_article_title,
          blog_article_short_description: this.form.blog_article_short_description,
          blog_article_media_url: 'test', // this.form.blog_article_media_url,
          blog_article_content: {
            section_1: this.form.blog_article_content.section_1,
            section_2: this.form.blog_article_content.section_2,
            section_3: this.form.blog_article_content.section_3,
            section_4: this.form.blog_article_content.section_4,
            section_5: this.form.blog_article_content.section_5
          },
          blog_article_is_active: this.form.blog_article_is_active
        })
        .then(response => {
          this.blogSubcategoryTitle = response.data.blog_subcategory_title
          Swal.fire({
            title: 'Title article created successfully',
            text: 'Body article created successfully'
          }).then((result) => {
            this.form.blog_subcategory = null
          })
        })
        .catch(error => {
          this.blogSubcategoryTitle = error.response.config.blog_subcategory_title
          this.blogArticleTitle = error.response.config.blog_article_title
          if (error.response.status === 406 || error.response.status === 500) {
            Swal.fire({
              title: 'Title article error',
              text: 'Body article error'
            })
          }
          if (error.response.status === 422) {
            Swal.fire({
              title: 'Title article required fields',
              text: 'Body article required fields'
            })
          }
        })
    }
  },
  metaInfo () {
    return { title: 'Admin - User New Blog Article' }
  }
}
</script>
<style lang="scss">

</style>
