<template>
  <!-- ADD NEW MESSAGE, SECTION START -->
  <div id="createNewMessage" class="modal fade" tabindex="-1" aria-labelledby="createNewMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewMessageLabel" class="modal-title">
            CREATE NEW MESSAGE
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewMessage" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="full_name"
                     v-model="form.full_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('full_name') }"
                     class="form-control"
                     placeholder="Insert your full name"
                     name="full_name"
              >
              <has-error :form="form" field="full_name" />
            </div>
            <div class="col col-12 my-3">
              <input id="email"
                     v-model="form.email"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('email') }"
                     class="form-control"
                     placeholder="Insert email address"
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
                        placeholder="Insert email address"
                        name="message"
              />
              <has-error :form="form" field="message" />
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
    <!-- ADD NEW MESSAGE, SECTION END -->
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
  name: 'NewMessage',
  data: function () {
    return {
      form: new Form({
        full_name: '',
        email: '',
        message: ''
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewMessage () {
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
        const apiEndPoint = '/api/admin/system/contact-me'
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.post(fullApiUrl, {
            full_name: this.form.full_name,
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
                this.form.full_name = ''
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
          if (err.response.status === 406) {
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
