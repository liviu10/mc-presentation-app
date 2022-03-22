<template>
  <!-- EDIT ERROR AND NOTIFICATION, SECTION START -->
  <div id="editErrorAndNotification" class="modal fade" tabindex="-1" aria-labelledby="editErrorAndNotificationLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editErrorAndNotificationLabel" class="modal-title">
            EDIT ERROR AND NOTIFICATION
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="notify_code"
                     v-model="form.notify_code"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('notify_code') }"
                     class="form-control"
                     :placeholder="editRow.notify_code"
                     name="notify_code"
              >
              <has-error :form="form" field="notify_code" />
            </div>
            <div class="col col-12 my-3">
              <input id="notify_short_description"
                     v-model="form.notify_short_description"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('notify_short_description') }"
                     class="form-control"
                     :placeholder="editRow.notify_short_description"
                     name="notify_short_description"
              >
              <has-error :form="form" field="notify_short_description" />
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
  <!-- EDIT ERROR AND NOTIFICATION, SECTION END -->
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
  name: 'EditErrorAndNotification',
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
        notify_code: this.editRow.notify_code,
        notify_short_description: this.editRow.notify_short_description
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
            this.form.notify_code = ''
            this.form.notify_short_description = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/errors-and-notifications/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.put(fullApiUrl, {
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
        }
      }
    }
  }
}
</script>
