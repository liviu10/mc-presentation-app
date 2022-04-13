<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayAllBlogCategories"
            :search-options="{
              enabled: true
            }"
            :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 15,
              position: 'bottom',
              perPageDropdown: [30, 45, 60, 'All'],
              dropdownAllowAll: false,
              setCurrentPage: 1,
              jumpFirstOrLast : true,
              firstLabel : 'First Page',
              lastLabel : 'Last Page',
              nextLabel: 'next',
              prevLabel: 'prev',
              rowsPerPageLabel: 'Rows per page',
              ofLabel: 'of',
              pageLabel: 'page',
              allLabel: 'All',
            }"
          >
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'blog_category_is_active'">
                <span v-if="props.formattedRow[props.column.field] === '1'">
                  Yes
                </span>
                <span v-else>
                  No
                </span>
              </span>
              <span v-else-if="props.column.field == 'blog_image_card_url'">
                <img :src="displayLocationUrl + '' + props.formattedRow['blog_image_card_url']"
                     :alt="'Blog category title ' + props.formattedRow['blog_category_title'] + ' image card'"
                     width="320"
                     height="240"
                >
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.formattedRow['created_at']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-info w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#showBlogCategory"
                        @click="showBlogCategory(props.row)"
                >
                  <fa icon="eye" fixed-width /> Show
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-warning w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#editBlogCategory"
                        @click="editBlogCategory(props.row)"
                >
                  <fa icon="edit" fixed-width /> Edit
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <show-blog-category :show-row="selectedData" :location-url="displayLocationUrl" />

        <!-- EDIT BLOG CATEGORY, SECTION START -->
        <div id="editBlogCategory"
             class="modal fade"
             tabindex="-1"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             aria-labelledby="editBlogCategoryLabel"
             aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="editBlogCategoryLabel" class="modal-title">
                  Edit blog category title "{{ selectedData.blog_category_title }}"
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
              </div>
              <div class="modal-body">
                <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
                  <div class="col col-12 my-3">
                    <label class="col-form-label">
                      Category title
                    </label>
                    <input id="blog_category_title"
                           v-model="form.blog_category_title"
                           type="text"
                           :class="{ 'is-invalid': form.errors.has('blog_category_title') }"
                           class="form-control"
                           name="blog_category_title"
                    >
                    <has-error :form="form" field="blog_category_title" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="col-form-label">
                      Category short description
                    </label>
                    <textarea id="blog_category_short_description"
                              v-model="form.blog_category_short_description"
                              type="text"
                              :class="{ 'is-invalid': form.errors.has('blog_category_short_description') }"
                              class="form-control"
                              name="blog_category_short_description"
                              rows="8"
                              style="resize:none"
                    />
                    <has-error :form="form" field="blog_category_short_description" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="col-form-label">
                      Activate blog category?
                    </label>
                    <select id="blog_category_is_active"
                            v-model="form.blog_category_is_active"
                            class="form-select"
                            :class="{ 'is-invalid': form.errors.has('blog_category_is_active') }"
                            name="blog_category_is_active"
                            aria-label="Default select example"
                    >
                      <option value="1">
                        Yes
                      </option>
                      <option value="2">
                        No
                      </option>
                    </select>
                    <has-error :form="form" field="blog_category_is_active" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="col-form-label">
                      Change category image
                    </label>
                    <input id="blog_category_path"
                           type="file"
                           :class="{ 'is-invalid': form.errors.has('blog_category_path') }"
                           class="form-control"
                           name="blog_category_path"
                           accept="image/png, image/jpeg, image/jpg"
                           @change="uploadBlogCategoryImageCard($event)"
                    >
                    <has-error :form="form" field="blog_category_path" />
                  </div>
                  <div class="modal-buttons">
                    <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- EDIT BLOG CATEGORY, SECTION END -->
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
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import ShowBlogCategory from './show'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogCategories',
  components: {
    VueGoodTable,
    ShowBlogCategory
  },
  middleware: 'auth',
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Category title',
          field: 'blog_category_title'
        },
        {
          label: 'Category short description',
          field: 'blog_category_short_description',
          sortable: false
        },
        {
          label: 'Active?',
          field: 'blog_category_is_active',
          hidden: true
        },
        {
          label: 'Category image',
          field: 'blog_image_card_url',
          sortable: false
        },
        {
          label: 'Category path',
          field: 'blog_category_path',
          hidden: true
        },
        {
          label: 'Date created',
          field: 'created_at',
          hidden: true
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false
        }
      ],
      selectedData: {},
      form: new Form({
        blog_category_title: '',
        blog_category_short_description: '',
        blog_category_is_active: '',
        blog_image_card_url: ''
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      blogCategories: 'blog/blogCategories'
    }),
    displayAllBlogCategories () {
      return this.blogCategories.records
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
  },
  updated () {
    this.emitToParentCategoryList()
  },
  methods: {
    ...mapActions({
      fetchBlogCategories: 'blog/fetchBlogCategories'
    }),
    async showBlogCategory (row) {
      this.selectedData = row
      return this.selectedData
    },
    async editBlogCategory (row) {
      this.selectedData = row
      this.form.blog_category_title = this.selectedData.blog_category_title
      this.form.blog_category_short_description = this.selectedData.blog_category_short_description
      this.form.blog_category_is_active = this.selectedData.blog_category_is_active
      this.form.blog_image_card_url = this.selectedData.blog_image_card_url
      return this.selectedData
    },
    uploadBlogCategoryImageCard (event) {
      this.form.blog_image_card_url = event.target.files[0]
      const formData = new FormData()
      formData.append('file', this.form.blog_image_card_url)
    },
    async edit () {
      if (!this.user) {
        Swal.fire({
          title: 'Unauthenticated User Title',
          text: 'Unauthenticated User Text Message',
          confirmButtonText: 'Login',
          showCancelButton: true,
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            this.form.blog_category_title = ''
            this.form.blog_category_short_description = ''
            this.form.blog_category_is_active = ''
            this.form.blog_image_card_url = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/blog/edit-category/'
        const urlParam = this.selectedData.id
        const fullApiUrl = url + apiEndPoint + urlParam
        try {
          await this.form.post(fullApiUrl, {
            blog_category_title: this.form.blog_category_title,
            blog_category_short_description: this.form.blog_category_short_description,
            blog_category_is_active: this.form.blog_category_is_active,
            blog_image_card_url: this.form.blog_image_card_url
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted blog category name: ' + response.data.records.blog_category_title + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.blog_category_title = ''
                this.form.blog_category_short_description = ''
                this.form.blog_category_is_active = ''
                this.form.blog_image_card_url = ''
                window.location.reload()
              })
            })
        } catch (err) {
          if (err.response.status === 500) {
            console.log('> error message: ')
            this.$refs.close.click()
            Swal.fire({
              title: err.response.data.title,
              html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>' +
                  '<p>Inserted blog category name: ' + this.form.campaign + '</p>'
            })
          }
        }
      }
    },
    emitToParentCategoryList (event) {
      this.$emit('blog-categories', this.displayAllBlogCategories)
    }
  }
}
</script>
