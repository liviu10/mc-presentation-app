<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN BLOG CATEGORIES AND SUBCATEGORIES PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayAdminAllBlogCategoriesAndSubcategories"
            :search-options="{
              enabled: true
            }"
            :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 50,
              position: 'bottom',
              perPageDropdown: [100, 200, 300, 400, 500],
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
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createNewCategory">
                <fa icon="pencil-alt" fixed-width />
              </button>
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createNewSubcategory">
                <fa icon="pencil-alt" fixed-width />
              </button>
              <button class="btn btn-danger" @click="deleteAllBlogCategoriesAndSubcategories()">
                <fa icon="trash" fixed-width />
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'blog_category_is_active'">
                <span v-if="props.row.blog_category_is_active === '1'">Yes</span>
                <span v-else>No</span>
              </span>
              <span v-else-if="props.column.field == 'blog_image_card_url'">
                <img :src="props.row.blog_image_card_url" width="320" height="240" alt="...">
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#showBlogCategoryAndSubcategory" @click="showBlogCategoryAndSubcategory(props.row)">
                  <fa icon="eye" fixed-width />
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editBlogCategoryAndSubcategory" @click="editBlogCategoryAndSubcategory(props.row)">
                  <fa icon="edit" fixed-width />
                </button>
                <button class="btn btn-danger" @click="deleteCategoryAndSubcategory(props.row)">
                  <fa icon="trash" fixed-width />
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <new-blog-category />

        <new-blog-subcategory :blog-category-options="displayAdminAllBlogCategoriesAndSubcategories" />

        <show-blog-category-and-subcategory :show-row="selectedDataToShow" />

        <edit-blog-category-and-subcategory :edit-row="selectedDataToEdit" />
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewBlogCategory from './new-blog-category'
import NewBlogSubcategory from './new-blog-subcategory'
import ShowBlogCategoryAndSubcategory from './show-blog-category-and-subcategory'
import EditBlogCategoryAndSubcategory from './edit-blog-category-and-subcategory'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogCategoriesAndSubcategories',
  components: {
    VueGoodTable,
    NewBlogCategory,
    NewBlogSubcategory,
    ShowBlogCategoryAndSubcategory,
    EditBlogCategoryAndSubcategory
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
          label: 'Category Title',
          field: 'blog_category_title'
        },
        {
          label: 'Short Description',
          field: 'blog_category_short_description'
        },
        {
          label: 'Category Image',
          field: 'blog_image_card_url'
        },
        {
          label: 'Category path',
          field: 'blog_category_path'
        },
        {
          label: 'Created at',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions'
        }
      ],
      selectedDataToShow: {},
      selectedDataToEdit: {}
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      adminAllBlogCategoriesAndSubcategories: 'blog/adminAllBlogCategoriesAndSubcategories'
    }),
    displayAdminAllBlogCategoriesAndSubcategories () {
      return this.adminAllBlogCategoriesAndSubcategories.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.adminAllBlogCategoriesAndSubcategories.http_response_code
    }
  },
  created () {
    this.fetchAdminBlogCategoriesAndSubcategories()
  },
  methods: {
    ...mapActions({
      fetchAdminBlogCategoriesAndSubcategories: 'blog/fetchAdminBlogCategoriesAndSubcategories'
    }),
    showBlogCategoryAndSubcategory (row) {
      this.selectedDataToShow = row
      return this.selectedDataToShow
    },
    editBlogCategoryAndSubcategory (row) {
      this.selectedDataToEdit = row
      return this.selectedDataToEdit
    },
    deleteCategoryAndSubcategory (row) {
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
        const apiEndPoint = '/api/admin/system/blog/delete-category'
        const urlParam = row.id
        const fullApiUrl = url + apiEndPoint + '/' + urlParam
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
                            '<p>Deleted blog category: ' + results.data.records.blog_category_title + '</p>'
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
    },
    deleteAllBlogCategoriesAndSubcategories () {
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
        const apiEndPoint = '/api/admin/system/blog/delete-all-categories'
        const fullApiUrl = url + apiEndPoint
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            try {
              axios.delete(fullApiUrl)
                .then((results) => {
                  console.log('> response message: ')
                  Swal.fire({
                    title: results.data.title,
                    html:
                            '<p>Notify code: ' + '<a href="' + results.data.reference + '">' + results.data.notify_code + '</a>' + '</p>' +
                            '<p>' + results.data.description + '</p>'
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
  },
  metaInfo () {
    return { title: 'Admin - Blog categories and subcategories' }
  }
}
</script>
