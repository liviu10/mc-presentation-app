<template>
  <!-- ADD NEW BLOG SUBCATEGORY, SECTION START -->
  <div id="createNewSubcategory" class="modal fade" tabindex="-1" aria-labelledby="createNewSubcategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewSubcategoryLabel" class="modal-title">
            CREATE NEW BLOG SUBCATEGORY
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewSubcategory" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <div class="input-group mb-3">
                <select id="blog_category_id"
                        v-model="form.blog_category_id"
                        name="form.blog_category_id"
                        class="form-select input-group-text"
                        aria-label="Default select example"
                >
                  <option selected>
                    Select a Blog Category
                  </option>
                  <option v-for="item in blogCategoryOptions" :key="item.id" :value="item.id">
                    {{ item.blog_category_title }}
                  </option>
                </select>
                <input id="blog_subcategory_title"
                       v-model="form.blog_subcategory_title"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('blog_subcategory_title') }"
                       class="form-control"
                       placeholder="Insert blog subcategory title"
                       name="blog_subcategory_title"
                >
                <has-error :form="form" field="blog_category_id" />
                <has-error :form="form" field="blog_subcategory_title" />
              </div>
            </div>
            <div class="col col-12 my-3">
              <textarea id="blog_subcategory_short_description"
                        v-model="form.blog_subcategory_short_description"
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('blog_subcategory_short_description') }"
                        class="form-control"
                        placeholder="Insert blog subcategory short description"
                        name="blog_subcategory_short_description"
              />
              <has-error :form="form" field="blog_subcategory_short_description" />
            </div>
            <div class="col col-12 my-3">
              <input id="blog_subcategory_is_active"
                     v-model="form.blog_subcategory_is_active"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_subcategory_is_active') }"
                     class="form-control"
                     placeholder="Blog subcategory is active?"
                     name="blog_subcategory_is_active"
              >
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
  name: 'NewBlogCategory',
  props: {
    blogCategoryOptions: {
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
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewSubcategory () {
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
          console.log('> blog image card url', this.form)
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
                    '<p>Inserted blog subcategory: ' + response.data.records.blog_subcategory_title + '</p>'
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
                  '<p>Inserted blog subcategory: ' + this.form.blog_subcategory_title + '</p>'
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
                  '<p>Inserted blog subcategory: ' + this.form.blog_subcategory_title + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
