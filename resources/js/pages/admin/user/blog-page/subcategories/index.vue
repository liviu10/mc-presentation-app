<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayAllBlogSubcategories"
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
            <div slot="table-actions">
              <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2" class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#createNewBlogSubcategory">
                <fa icon="pencil-alt" fixed-width /> Add new
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'blog_category'">
                {{ props.formattedRow[props.column.field].blog_category_title }}
              </span>
              <span v-else-if="props.column.field == 'blog_subcategory_is_active'">
                <span v-if="props.formattedRow[props.column.field] === '1'">
                  Yes
                </span>
                <span v-else>
                  No
                </span>
              </span>
              <span v-else-if="props.column.field == 'blog_subcategory_path'">
                <a :href="displayLocationUrl + '' + props.formattedRow['blog_subcategory_path']" target="_blank">
                  {{ props.formattedRow['blog_subcategory_title'] }}
                </a>
                <span class="ms-1">
                  <fa :icon="['fa', 'external-link-alt']" fixed-width />
                </span>
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.formattedRow['created_at']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-warning w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#editBlogSubcategory"
                        @click="editBlogSubcategory(props.row)"
                >
                  <fa icon="edit" fixed-width /> Edit
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-danger w-100"
                        @click="deleteBlogSubcategory(props.row)"
                >
                  <fa icon="trash" fixed-width /> Delete
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <new-blog-category :category-details="blogCategoriesList" />

        <!-- EDIT BLOG CATEGORY, SECTION START -->
        <div id="editBlogSubcategory"
             class="modal fade"
             tabindex="-1"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             aria-labelledby="editBlogSubcategoryLabel"
             aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="editBlogSubcategoryLabel" class="modal-title">
                  Edit blog category title "{{ selectedData.blog_subcategory_title }}"
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
              </div>
              <div class="modal-body">
                <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
                  <div class="col col-12 my-3">
                    <div class="col col-12 my-3">
                      <label class="col-form-label">
                        Category title:
                      </label>
                      <select id="blog_category_id"
                              v-model="form.blog_category_id"
                              class="form-select"
                              :class="{ 'is-invalid': form.errors.has('blog_category_id') }"
                              name="blog_category_id"
                              aria-label="Default select example"
                      >
                        <optgroup v-for="item in blogCategoriesList" :key="item.id" label="Category">
                          <option :value="item.id">
                            {{ item.blog_category_title }}
                          </option>
                          <option disabled>
                            Status:
                            <span v-if="item.blog_category_is_active === '1'">
                              active
                            </span>
                            <span v-else>
                              inactive
                            </span>
                          </option>
                        </optgroup>
                      </select>
                      <has-error :form="form" field="blog_category_id" />
                    </div>
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
                  <div class="col col-12 my-3">
                    <label class="col-form-label">
                      Category short description
                    </label>
                    <textarea id="blog_subcategory_short_description"
                              v-model="form.blog_subcategory_short_description"
                              type="text"
                              :class="{ 'is-invalid': form.errors.has('blog_subcategory_short_description') }"
                              class="form-control"
                              name="blog_subcategory_short_description"
                              rows="8"
                              style="resize:none"
                    />
                    <has-error :form="form" field="blog_subcategory_short_description" />
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
import NewBlogCategory from './new'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogCategories',
  components: {
    VueGoodTable,
    NewBlogCategory
  },
  middleware: 'auth',
  props: {
    blogCategoriesList: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Category title',
          field: 'blog_category'
        },
        {
          label: 'Subcategory title',
          field: 'blog_subcategory_title'
        },
        {
          label: 'Active?',
          field: 'blog_subcategory_is_active'
        },
        {
          label: 'Subcategory path',
          field: 'blog_subcategory_path'
        },
        {
          label: 'Date created',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false
        }
      ],
      selectedData: {},
      form: new Form({
        blog_category_id: '',
        blog_subcategory_title: '',
        blog_subcategory_short_description: '',
        blog_subcategory_is_active: ''
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      blogSubcategories: 'blog/blogSubcategories'
    }),
    displayAllBlogSubcategories () {
      return this.blogSubcategories.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.blogSubcategories.http_response_code
    },
    displayLocationUrl () {
      return window.location.origin
    }
  },
  created () {
    this.fetchBlogSubcategories()
  },
  methods: {
    ...mapActions({
      fetchBlogSubcategories: 'blog/fetchBlogSubcategories'
    }),
    async editBlogSubcategory (row) {
      this.selectedData = row
      this.form.blog_category_id = this.selectedData.blog_category_id
      this.form.blog_subcategory_title = this.selectedData.blog_subcategory_title
      this.form.blog_subcategory_short_description = this.selectedData.blog_subcategory_short_description
      this.form.blog_subcategory_is_active = this.selectedData.blog_subcategory_is_active
      return this.selectedData
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
            this.form.blog_category_id = ''
            this.form.blog_subcategory_title = ''
            this.form.blog_subcategory_short_description = ''
            this.form.blog_subcategory_is_active = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/blog/edit-subcategory/'
        const urlParam = this.selectedData.id
        const fullApiUrl = url + apiEndPoint + urlParam
        try {
          await this.form.post(fullApiUrl, {
            blog_category_id: this.form.blog_category_id,
            blog_subcategory_title: this.form.blog_subcategory_title,
            blog_subcategory_short_description: this.form.blog_subcategory_short_description,
            blog_subcategory_is_active: this.form.blog_subcategory_is_active
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.blog_category_id = ''
                this.form.blog_subcategory_title = ''
                this.form.blog_subcategory_short_description = ''
                this.form.blog_subcategory_is_active = ''
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
                  '<p>' + err.response.data.description + '</p>'
            })
          }
        }
      }
    },
    async deleteBlogSubcategory (row) {
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
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/blog/delete-subcategory/'
        const urlParam = row.id
        const fullApiUrl = url + apiEndPoint + urlParam
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            try {
              axios.delete(fullApiUrl, { id: urlParam })
                .then((results) => {
                  console.log('> response message: ')
                  Swal.fire({
                    title: results.data.title,
                    html:
                            '<p>Notify code: ' + '<a href="' + results.data.reference + '">' + results.data.notify_code + '</a>' + '</p>' +
                            '<p>' + results.data.description + '</p>' +
                            '<p>Deleted blog subcategory name: ' + results.data.records.blog_subcategory_title + '</p>'
                  }).then((results) => {
                    if (result.isConfirmed) {
                      console.log('> result message: ')
                      window.location.reload()
                    }
                  })
                })
            } catch (err) {
              if (err.response.status === 500) {
                console.log('> error message: ')
                Swal.fire({
                  title: err.response.data.title,
                  html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>'
                })
              }
            }
          }
        })
      }
    }
  }
}
</script>
