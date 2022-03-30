<template>
  <!-- EDIT BLOG CATEGORY, SECTION START -->
  <div id="editBlogCategoryAndSubcategory" class="modal fade" tabindex="-1" aria-labelledby="editBlogCategoryAndSubcategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editBlogCategoryAndSubcategoryLabel" class="modal-title">
            EDIT BLOG CATEGORY
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="blog_category_title"
                     v-model="form.blog_category_title"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_category_title') }"
                     class="form-control"
                     :placeholder="editRow.blog_category_title"
                     name="blog_category_title"
              >
              <has-error :form="form" field="blog_category_title" />
            </div>
            <div class="col col-12 my-3">
              <textarea id="blog_category_short_description"
                        v-model="form.blog_category_short_description"
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('blog_category_short_description') }"
                        class="form-control"
                        :placeholder="editRow.blog_category_short_description"
                        name="blog_category_short_description"
              />
              <has-error :form="form" field="blog_category_short_description" />
            </div>
            <div class="col col-12 my-3">
              <input id="blog_category_is_active"
                     v-model="form.blog_category_is_active"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('blog_category_is_active') }"
                     class="form-control"
                     :placeholder="editRow.blog_category_is_active"
                     name="blog_category_is_active"
              >
              <has-error :form="form" field="blog_category_is_active" />
            </div>
            <div class="col col-12 my-3">
              <label for="blog_image_card_url" class="form-label">Upload blog category image card</label>
              <input id="blog_image_card_url"
                     class="form-control"
                     :class="{ 'is-invalid': form.errors.has('blog_image_card_url') }"
                     type="file"
                     name="blog_image_card_url"
                     @change="uploadBlogCategoryImageCard($event)"
              >
              <has-error :form="form" field="blog_image_card_url" />
            </div>
            <div class="modal-buttons">
              <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- EDIT BLOG CATEGORY, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import axios from 'axios'
import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'EditBlogCategoryAndSubcategory',
  middleware: 'auth',
  props: {
    editRow: {
      default: null,
      type: Object
    }
  },
  data: function () {
    return {
      form: new Form({
        blog_category_title: this.editRow.blog_category_title,
        blog_category_short_description: this.editRow.blog_category_short_description,
        blog_category_is_active: this.editRow.blog_category_is_active,
        blog_image_card_url: ''
      })
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    uploadBlogCategoryImageCard (event) {
      this.form.blog_image_card_url = event.target.files[0]
      const formData = new FormData()
      formData.append('_method', 'POST')
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
        const apiEndPoint = '/api/admin/system/blog/edit-category/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
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
                    '<p>Inserted domain name and type: ' + response.data.records.blog_category_title + '</p>'
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
                  '<p>Inserted domain name and type: ' + err.response.data.records.blog_category_title + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
