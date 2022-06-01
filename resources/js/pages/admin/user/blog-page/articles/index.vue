<template>
  <div class="articles-section">
    <div class="articles-section-body">
      <vue-good-table
        :columns="columns"
        :rows="displayAllBlogArticles"
        :search-options="{
          enabled: true
        }"
        :pagination-options="{
          enabled: true,
          mode: 'records',
          perPage: 10,
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
          <button v-if="user.user_role_type_id === 1"
                  class="btn btn-primary me-2"
                  type="button"
                  @click="createNewBlogArticles()"
          >
            <fa icon="pencil-alt" fixed-width /> Add new
          </button>
        </div>
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'blog_category_title'">
            <a :href="displayLocationUrl + '' + props.row.blog_subcategory.blog_category.blog_category_path"
               target="_blank"
               style="display: inline-block"
            >
              {{ props.row.blog_subcategory.blog_category.blog_category_title }}
              <span class="ms-1">
                <fa :icon="['fa', 'external-link-alt']" fixed-width />
              </span>
            </a>
          </span>
          <span v-if="props.column.field == 'blog_subcategory_title'">
            <a :href="displayLocationUrl + '' + props.row.blog_subcategory.blog_subcategory_path"
               target="_blank"
               style="display: inline-block"
            >
              {{ props.row.blog_subcategory.blog_subcategory_title }}
              <span class="ms-1">
                <fa :icon="['fa', 'external-link-alt']" fixed-width />
              </span>
            </a>
          </span>
          <span v-if="props.column.field == 'blog_article_title'">
            <a :href="displayLocationUrl + '' + props.row.blog_article_path + '/' + props.row.id"
               target="_blank"
               style="display: inline-block"
            >
              {{ props.row.blog_article_title }}
              <span class="ms-1">
                <fa :icon="['fa', 'external-link-alt']" fixed-width />
              </span>
            </a>
          </span>
          <span v-else-if="props.column.field == 'blog_article_is_active'">
            <span v-if="props.formattedRow[props.column.field] === '1'">
              Yes
            </span>
            <span v-else>
              No
            </span>
          </span>
          <span v-else-if="props.column.field == 'appreciation_system'">
            <span v-if="props.row.blog_article_like.length === 0 && props.row.blog_article_dislike.length === 0 && props.row.blog_article_rate.length === 0">
              0 likes,
              0 dislikes,
              0 rate
            </span>
            <span v-else-if="props.row.blog_article_like.length === 0 && props.row.blog_article_dislike.length && props.row.blog_article_rate.length">
              0 likes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} dislikes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} rate
            </span>
            <span v-else-if="props.row.blog_article_like.length && props.row.blog_article_dislike.length === 0 && props.row.blog_article_rate.length">
              {{ props.row.blog_article_like.blog_article_likes }} likes,
              0 dislikes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} rate
            </span>
            <span v-else-if="props.row.blog_article_like.length && props.row.blog_article_dislike.length && props.row.blog_article_rate.length === 0">
              {{ props.row.blog_article_like.blog_article_likes }} likes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} dislikes,
              0 rate
            </span>
            <span v-else>
              {{ props.row.blog_article_like.blog_article_likes }} likes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} dislikes,
              {{ props.row.blog_article_dislike.blog_article_dislikes }} rate
            </span>
          </span>
          <span v-else-if="props.column.field == 'created_at'">
            {{ new Date(props.formattedRow['created_at']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
          </span>
          <span v-else-if="props.column.field == 'actions'">
            <button v-if="user.user_role_type_id === 1"
                    class="btn btn-info w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#showBlogArticle"
                    @click="showBlogArticle(props.row)"
            >
              <fa icon="eye" fixed-width /> Show
            </button>
            <button v-if="user.user_role_type_id === 1"
                    class="btn btn-success w-100"
                    type="button"
                    @click="showBlogArticleComments(props.row)"
            >
              <fa icon="comment" fixed-width /> Show Comments
            </button>
            <button v-if="user.user_role_type_id === 1"
                    class="btn btn-warning w-100"
                    type="button"
                    @click="editBlogArticle(props.row)"
            >
              <fa icon="edit" fixed-width /> Edit
            </button>
            <button v-if="user.user_role_type_id === 1"
                    class="btn btn-danger w-100"
                    @click="deleteBlogArticle(props.row)"
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

    <show-blog-article :show-row="selectedData" :location-url="displayLocationUrl" />
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import ShowBlogArticle from './show'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogArticles',
  components: {
    VueGoodTable,
    ShowBlogArticle
  },
  middleware: 'auth',
  props: {
    blogCategoriesList: {
      default: null,
      type: Array
    },
    blogSubcategoriesList: {
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
          field: 'blog_category_title'
        },
        {
          label: 'Subcategory title',
          field: 'blog_subcategory_title'
        },
        {
          label: 'Article title',
          field: 'blog_article_title'
        },
        {
          label: 'Active?',
          field: 'blog_article_is_active'
        },
        {
          label: 'Number of likes, dislikes and rate',
          field: 'appreciation_system'
        },
        {
          label: 'Number of likes',
          field: 'blog_article_like',
          hidden: true
        },
        {
          label: 'Number of dislikes',
          field: 'blog_article_dislike',
          hidden: true
        },
        {
          label: 'Number of votes',
          field: 'blog_article_rate',
          hidden: true
        },
        {
          label: 'Date created',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false,
          width: '200px'
        }
      ],
      selectedData: {}
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      blogArticles: 'blog/blogArticles'
    }),
    displayAllBlogArticles () {
      return this.blogArticles.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.blogArticles.http_response_code
    },
    displayLocationUrl () {
      return window.location.origin
    }
  },
  created () {
    this.fetchBlogArticles()
  },
  methods: {
    ...mapActions({
      fetchBlogArticles: 'blog/fetchBlogArticles'
    }),
    createNewBlogArticles () {
      this.$router.push({ name: 'admin-user-blog-page-new-article' })
    },
    async showBlogArticle (row) {
      this.selectedData = row
      return this.selectedData
    },
    showBlogArticleComments (id) {
      this.$router.push({ name: 'admin-user-blog-page-comments' })
    },
    editBlogArticle () {
      this.$router.push({ name: 'admin-user-blog-page-edit-article' })
    },
    async deleteBlogArticle (row) {
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
