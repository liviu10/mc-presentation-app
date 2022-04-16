<template>
  <!-- ADD NEW BLOG SUBCATEGORY, SECTION START -->
  <div id="createNewBlogSubcategory"
       class="modal fade"
       tabindex="-1"
       data-bs-backdrop="static"
       data-bs-keyboard="false"
       aria-labelledby="createNewBlogSubcategoryLabel"
       aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewBlogSubcategoryLabel" class="modal-title">
            Create a new blog subcategory
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewBlogSubcategory" @keydown="form.onKeydown($event)">
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
                  <optgroup v-for="item in categoryDetails" :key="item.id" label="Category">
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
          </form>
        </div>
      </div>
    </div>
    <!-- ADD NEW BLOG SUBCATEGORY, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import axios from 'axios'
import Form from 'vform'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'NewBlogSubcategory',
  props: {
    categoryDetails: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      form: new Form({
        blog_category_id: '',
        blog_subcategory_title: '',
        blog_subcategory_short_description: '',
        blog_subcategory_is_active: ''
      })
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewBlogSubcategory () {
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
        const apiEndPoint = '/api/admin/system/blog/create-subcategory'
        const fullApiUrl = url + apiEndPoint
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
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted blog subcategory name: ' + response.data.records.blog_subcategory_title + '</p>'
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
                  '<p>' + err.response.data.description + '</p>' +
                  '<p>Inserted blog subcategory name: ' + this.form.blog_subcategory_title + '</p>'
            })
          }
          if (err.response.status === 406) {
            console.log('> error message: ')
            this.$refs.close.click()
            Swal.fire({
              title: err.response.data.title,
              html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>' +
                  '<p>Inserted blog category name: ' + this.form.blog_subcategory_title + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
