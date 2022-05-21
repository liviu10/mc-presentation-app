<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN CREATE NEW BLOG ARTICLES</h1>
        </div>
        <div class="lv-pg-admin-body">
          <form @submit.prevent="createNewArticle" @keydown="form.onKeydown($event)">
            <!-- BLOG SUBCATEGORY, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-subcategory">
              <label class="col-form-label">
                Select the blog subcategory for this article
                <div id="blog_subcategory_id_help" class="form-text mt-0">
                  You can select only one blog subcategory. Each of the three blog categories will generate its specific template for writing articles.
                </div>
              </label>
              <select id="blog_subcategory_id"
                      v-model="form.blog_subcategory_id"
                      class="form-select"
                      :class="{ 'is-invalid': form.errors.has('blog_subcategory_id') }"
                      name="blog_subcategory_id"
                      aria-label="Default select example"
              >
                <!-- <option v-for="subcategory in displayAllBlogCategoriesAndSubcategories" :key="subcategory.id" :value="subcategory.id">
                  {{ subcategory.blog_category_title }}
                </option> -->
                <optgroup v-for="category in displayAllBlogCategoriesAndSubcategories" :key="category.id" :label="'Category: ' + category.blog_category_title">
                  <option v-for="subcategory in category.blog_subcategories" :key="subcategory.id" :value="subcategory.id">
                    {{ subcategory.blog_subcategory_title }}
                  </option>
                </optgroup>
              </select>
              <has-error :form="form" field="blog_subcategory_id" />
            </div>
            <!-- BLOG SUBCATEGORY, SECTION END -->

            <!-- BLOG ARTICLE TITLE, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-title">
              <label class="col-form-label">
                Article title
              </label>
              <input id="blog_article_title"
                     v-model="form.blog_article_title"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_article_title') }"
                     class="form-control"
                     name="blog_article_title"
              >
              <has-error :form="form" field="blog_article_title" />
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
            <!-- BLOG ARTICLE SHORT DESCRIPTION, SECTION END -->

            <!-- BLOG ARTICLE MEDIA, SECTION START -->
            <div class="col col-12 my-3 lv-pg-admin-body-blog-media">
              <label class="col-form-label">
                Article media
                <div id="blog_article_image_url_help" class="form-text mt-0">
                  Blog article media refers to image, audio or video that you whish to include in your article. Based on your blog subcategory selection, this section will be different
                  (eg. if you select a subcategory that belongs to Written blog articles category, you can upload a picture)
                </div>
              </label>
              <input id="blog_article_image_url"
                     type="file"
                     :class="{ 'is-invalid': form.errors.has('blog_article_image_url') }"
                     class="form-control"
                     name="blog_article_image_url"
                     accept="image/png, image/jpeg, image/jpg"
                     @change="uploadBlogArticleImage($event)"
              >
              <has-error :form="form" field="blog_article_image_url" />
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
            <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
              <label class="col-form-label">
                Section 1
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
            <div class="col col-12 my-3 lv-pg-admin-body-blog-content-button">
              <button type="button" class="btn btn-success" :hidden="settings.section_1.hideShowNextSectionButton" @click="showSection2()">
                <fa icon="plus" fixed-width /> Add a new section
              </button>
            </div>

            <div v-if="settings.section_1.displaySection2">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Section 2
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
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-button">
                <button type="button" class="btn btn-success" :hidden="settings.section_2.hideShowNextSectionButton" @click="showSection3()">
                  <fa icon="plus" fixed-width /> Add a new section
                </button>
                <button type="button" class="btn btn-warning" :hidden="settings.section_2.hideRemoveCurrentSectionButton" @click="removeSection2()">
                  <fa icon="times" fixed-width /> Remove section
                </button>
              </div>
            </div>

            <div v-if="settings.section_2.displaySection3">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Section 3
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
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-button">
                <button type="button" class="btn btn-success" :hidden="settings.section_3.hideShowNextSectionButton" @click="showSection4()">
                  <fa icon="plus" fixed-width /> Add a new section
                </button>
                <button type="button" class="btn btn-warning" :hidden="settings.section_3.hideRemoveCurrentSectionButton" @click="removeSection3()">
                  <fa icon="times" fixed-width /> Remove section
                </button>
              </div>
            </div>

            <div v-if="settings.section_3.displaySection4">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Section 4
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
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-button">
                <button type="button" class="btn btn-success" :hidden="settings.section_4.hideShowNextSectionButton" @click="showSection5()">
                  <fa icon="plus" fixed-width /> Add a new section
                </button>
                <button type="button" class="btn btn-warning" :hidden="settings.section_4.hideRemoveCurrentSectionButton" @click="removeSection4()">
                  <fa icon="times" fixed-width /> Remove section
                </button>
              </div>
            </div>

            <div v-if="settings.section_4.displaySection5">
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-section">
                <label class="col-form-label">
                  Section 5
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
              <div class="col col-12 my-3 lv-pg-admin-body-blog-content-button">
                <button type="button" class="btn btn-warning" @click="removeSection5()">
                  <fa icon="times" fixed-width /> Remove section
                </button>
              </div>
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
              <has-error :form="form" field="blog_subcategory_id" />
            </div>
            <!-- BLOG ARTICLE IS ACTIVE, SECTION END -->

            <div class="lv-pg-admin-body-buttons">
              <button type="button" class="btn btn-secondary">
                Cancel
              </button>
              <button type="submit" class="btn btn-success" @click="publishOrSaveDraftArticle()">
                Publish article
              </button>
              <button type="submit" class="btn btn-info" @click="publishOrSaveDraftArticle()">
                Save draft
              </button>
            </div>
          </form>
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
        blog_subcategory_id: '',
        blog_article_title: '',
        blog_article_image_url: '',
        blog_article_short_description: '',
        blog_article_content: {
          section_1: '',
          section_2: '',
          section_3: '',
          section_4: '',
          section_5: ''
        },
        blog_article_is_active: false
      }),
      hideBlogSubcategoryList: false,
      settings: {
        section_1: {
          hideShowNextSectionButton: false,
          displaySection2: false
        },
        section_2: {
          hideShowNextSectionButton: false,
          hideRemoveCurrentSectionButton: true,
          displaySection3: false
        },
        section_3: {
          hideShowNextSectionButton: false,
          hideRemoveCurrentSectionButton: true,
          displaySection4: false
        },
        section_4: {
          hideShowNextSectionButton: false,
          hideRemoveCurrentSectionButton: true,
          displaySection5: false
        }
      }
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
    showSection2 () {
      this.settings.section_1.hideShowNextSectionButton = true
      this.settings.section_1.displaySection2 = true
    },
    removeSection2 () {
      this.settings.section_1.hideShowNextSectionButton = false
      this.settings.section_1.displaySection2 = false
    },
    showSection3 () {
      this.settings.section_2.hideShowNextSectionButton = true
      this.settings.section_2.hideRemoveCurrentSectionButton = false
      this.settings.section_2.displaySection3 = true
    },
    removeSection3 () {
      this.settings.section_2.displaySection3 = false
    },
    showSection4 () {
      this.settings.section_3.hideShowNextSectionButton = true
      this.settings.section_3.hideRemoveCurrentSectionButton = false
      this.settings.section_3.displaySection4 = true
    },
    removeSection4 () {
      this.settings.section_3.displaySection4 = false
    },
    showSection5 () {
      this.settings.section_4.hideShowNextSectionButton = true
      this.settings.section_4.hideRemoveCurrentSectionButton = false
      this.settings.section_4.displaySection5 = true
    },
    removeSection5 () {
      this.settings.section_4.displaySection5 = false
    },
    async createNewArticle () {
      const url = window.location.origin
      const apiEndPoint = '/api/'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          blog_subcategory_id: this.form.blog_subcategory_id
        })
        .then(response => {
          this.blogSubcategoryTitle = response.data.blog_subcategory_title
          Swal.fire({
            title: 'Title article created successfully',
            text: 'Body article created successfully'
          }).then((result) => {
            this.form.blog_subcategory_id = null
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
