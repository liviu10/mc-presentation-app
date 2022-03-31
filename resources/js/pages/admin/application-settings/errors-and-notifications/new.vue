<template>
  <!-- ADD NEW ERROR AND NOTIFICATION, SECTION START -->
  <div id="createErrorAndNotification" class="modal fade" tabindex="-1" aria-labelledby="createErrorAndNotificationLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createErrorAndNotificationLabel" class="modal-title">
            CREATE NEW ERROR AND NOTIFICATION
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createErrorAndNotification" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <div class="input-group mb-3">
                <select id="notify_code_options"
                        v-model="form.notify_code_options"
                        name="form.notify_code_options"
                        class="form-select input-group-text"
                        aria-label=".form-select example"
                >
                  <option selected>
                    Select Prefix
                  </option>
                  <option value="1">
                    INFO
                  </option>
                  <option value="2">
                    WAR
                  </option>
                  <option value="3">
                    ERR
                  </option>
                </select>
                <input id="notify_code"
                       v-model="form.notify_code"
                       type="text"
                       :class="{ 'is-invalid': form.errors.has('notify_code') }"
                       class="form-control"
                       placeholder="Insert notification code"
                       name="notify_code"
                       aria-label="Username"
                       aria-describedby="basic-addon1"
                >
              </div>

              <has-error :form="form" field="notify_code" />
            </div>
            <div class="col col-12 my-3">
              <input id="notify_short_description"
                     v-model="form.notify_short_description"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('notify_short_description') }"
                     class="form-control"
                     placeholder="Insert notification short description"
                     name="notify_short_description"
              >
              <has-error :form="form" field="notify_short_description" />
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
    <!-- ADD NEW ERROR AND NOTIFICATION, SECTION END -->
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
  name: 'NewErrorAndNotification',
  data: function () {
    return {
      form: new Form({
        notify_code_options: '',
        notify_code: '',
        notify_short_description: ''
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createErrorAndNotification () {
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
            this.form.notify_code = ''
            this.form.notify_short_description = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/errors-and-notifications'
        const fullApiUrl = url + apiEndPoint
        try {
          console.log('notify_code_options', this.form.notify_code_options)
          await this.form.post(fullApiUrl, {
            notify_code_options: this.form.notify_code_options,
            notify_code: this.form.notify_code,
            notify_short_description: this.form.notify_short_description
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted notify code: ' + response.data.records.notify_code + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.notify_code_options = ''
                this.form.notify_code = ''
                this.form.notify_short_description = ''
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
                  '<p>Inserted notify code: ' + this.form.notify_code + '</p>'
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
                  '<p>Inserted notify code: ' + this.form.notify_code + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
