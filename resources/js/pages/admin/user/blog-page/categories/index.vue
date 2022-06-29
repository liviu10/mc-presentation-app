<template>
  <div class="lv-pg-admin-blog-section">
    <div class="lv-pg-admin-blog-section-body">
      <vue-good-table
        :columns="columns"
        :rows="displayAllBlogCategories"
        :search-options="{
          enabled: true
        }"
        :pagination-options="{
          enabled: true,
          mode: 'records',
          perPage: 3,
          position: 'bottom',
          perPageDropdown: [30, 45, 60, $t('admin.general_settings.table.all_label')],
          dropdownAllowAll: false,
          setCurrentPage: 1,
          jumpFirstOrLast : true,
          firstLabel: $t('admin.general_settings.table.first_page_label'),
          lastLabel: $t('admin.general_settings.table.last_page_label'),
          nextLabel: $t('admin.general_settings.table.next_label'),
          prevLabel: $t('admin.general_settings.table.previous_label'),
          rowsPerPageLabel: $t('admin.general_settings.table.rows_per_page'),
          ofLabel: $t('admin.general_settings.table.of_label'),
          pageLabel: $t('admin.general_settings.table.page_label'),
          allLabel: $t('admin.general_settings.table.all_label'),
        }"
      >
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'blog_category_is_active'">
            <span v-if="props.formattedRow[props.column.field] === '1'">
              {{ $t('admin.general_settings.table.active_label') }}
            </span>
            <span v-else>
              {{ $t('admin.general_settings.table.inactive_label') }}
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
            <button v-if="user.user_role_type_id <= 6"
                    class="btn btn-info w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#showBlogCategory"
                    @click="showBlogCategory(props.row)"
            >
              <fa icon="eye" fixed-width /> {{ $t('admin.general_settings.table.actions.show_record_label', { typeOfRecord: ''}) }}
            </button>
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'"
                    class="btn btn-warning w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#editBlogCategory"
                    @click="editBlogCategory(props.row)"
            >
              <fa icon="edit" fixed-width /> {{ $t('admin.general_settings.table.actions.edit_record_label') }}
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
              {{ $t('admin.blog_page.categories.edit_record.dialog_title') }} "{{ selectedData.blog_category_title }}"
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
          </div>
          <div class="modal-body">
            <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
              <div class="col col-12 my-3">
                <label class="col-form-label">
                  {{ $t('admin.blog_page.categories.edit_record.category_title_label') }}
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
                  {{ $t('admin.blog_page.categories.edit_record.category_short_desc_label') }}
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
                  {{ $t('admin.blog_page.categories.edit_record.category_status_label') }}
                </label>
                <select id="blog_category_is_active"
                        v-model="form.blog_category_is_active"
                        class="form-select"
                        :class="{ 'is-invalid': form.errors.has('blog_category_is_active') }"
                        name="blog_category_is_active"
                        aria-label="Default select example"
                >
                  <option value="1">
                    {{ $t('admin.general_settings.table.active_label') }}
                  </option>
                  <option value="2">
                    {{ $t('admin.general_settings.table.inactive_label') }}
                  </option>
                </select>
                <has-error :form="form" field="blog_category_is_active" />
              </div>
              <div class="col col-12 my-3">
                <label class="col-form-label">
                  {{ $t('admin.blog_page.categories.edit_record.category_image_label') }}
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
                  {{ $t('admin.general_settings.cancel_btn_label') }}
                </button>
                <button type="submit" class="btn btn-primary">
                  {{ $t('admin.general_settings.edit_btn_label') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- EDIT BLOG CATEGORY, SECTION END -->
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
          label: this.$t('admin.general_settings.table.id_column_label'),
          field: 'id'
        },
        {
          label: this.$t('admin.blog_page.categories.table.category_column_label'),
          field: 'blog_category_title'
        },
        {
          label: this.$t('admin.blog_page.categories.table.category_short_desc_column_label'),
          field: 'blog_category_short_description',
          sortable: false
        },
        {
          label: this.$t('admin.blog_page.categories.table.category_active_column_label'),
          field: 'blog_category_is_active',
          hidden: true
        },
        {
          label: this.$t('admin.blog_page.categories.table.category_image_column_label'),
          field: 'blog_image_card_url',
          sortable: false
        },
        {
          label: this.$t('admin.blog_page.categories.table.category_path_column_label'),
          field: 'blog_category_path',
          hidden: true
        },
        {
          label: this.$t('admin.general_settings.table.created_date_column_label'),
          field: 'created_at',
          hidden: true
        },
        {
          label: this.$t('admin.general_settings.table.action_column_label'),
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
