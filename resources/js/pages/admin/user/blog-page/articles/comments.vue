<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-comments">
        <div class="lv-pg-admin-comments-header">
          <h1>ADMIN BLOG ARTICLE COMMENTS</h1>
        </div>
        <div class="lv-pg-admin-comments-body">
          <vue-good-table
            :columns="columns"
            :rows="displayAllBlogArticleComments"
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
              <button v-if="user.user_role_type_id == '1'"
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
                <button v-if="user.user_role_type_id == '1'"
                        class="btn btn-info w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#showBlogArticle"
                        @click="showBlogArticle(props.row)"
                >
                  <fa icon="eye" fixed-width /> Show
                </button>
                <button v-if="user.user_role_type_id == '1'"
                        class="btn btn-success w-100"
                        type="button"
                        @click="showBlogArticleComments(props.row)"
                >
                  <fa icon="comment" fixed-width /> Show Comments
                </button>
                <button v-if="user.user_role_type_id == '1'"
                        class="btn btn-warning w-100"
                        type="button"
                        @click="editBlogArticle(props.row)"
                >
                  <fa icon="edit" fixed-width /> Edit
                </button>
                <button v-if="user.user_role_type_id == '1'"
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
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
// import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminBlogArticleComments',
  components: {
    VueGoodTable
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
          label: 'Blog article',
          field: 'blog_article'
        },
        {
          label: 'Full name',
          field: 'full_name'
        },
        {
          label: 'Email',
          field: 'email'
        },
        {
          label: 'Comment',
          field: 'comment'
        },
        {
          label: 'Is public?',
          field: 'comment_is_public'
        },
        {
          label: 'Privacy policy',
          field: 'privacy_policy'
        },
        {
          label: 'Date added',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false,
          width: '200px'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      blogArticleComments: 'blog/blogArticleComments'
    }),
    displayAllBlogArticleComments () {
      return this.blogArticleComments.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.blogArticleComments.http_response_code
    },
    displayLocationUrl () {
      return window.location.origin
    }
  },
  created () {
    this.fetchBlogArticleComments()
  },
  methods: {
    ...mapActions({
      fetchBlogArticleComments: 'blog/fetchBlogArticleComments'
    })
  },
  metaInfo () {
    return { title: 'Admin - User Blog Article Comments' }
  }
}
</script>
