<template>
  <!-- EDIT MESSAGE, SECTION START -->
  <div id="editMessage" class="modal fade" tabindex="-1" aria-labelledby="editMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editMessageLabel" class="modal-title">
            EDIT MESSAGE
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="full_name"
                     v-model="form.full_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('full_name') }"
                     class="form-control"
                     :placeholder="editRow.full_name"
                     name="full_name"
              >
              <has-error :form="form" field="full_name" />
            </div>
            <div class="col col-12 my-3">
              <input id="email"
                     v-model="form.email"
                     type="email"
                     :class="{ 'is-invalid': form.errors.has('email') }"
                     class="form-control"
                     :placeholder="editRow.email"
                     name="email"
              >
              <has-error :form="form" field="email" />
            </div>
            <div class="col col-12 my-3">
              <textarea id="message"
                        v-model="form.message"
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('message') }"
                        class="form-control"
                        :placeholder="editRow.message"
                        name="message"
              />
              <has-error :form="form" field="message" />
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
  <!-- EDIT MESSAGE, SECTION END -->
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
  name: 'EditMessages',
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
        full_name: this.editRow.full_name,
        email: this.editRow.email,
        message: this.editRow.message
      })
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
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
            this.form.full_name = ''
            this.form.email = ''
            this.form.message = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/contact-me/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.put(fullApiUrl, {
            domain: this.form.domain,
            email: this.form.email,
            message: this.form.message
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
                this.form.domain = ''
                this.form.email = ''
                this.form.message = ''
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
    }
  }
}
</script>
