<template>
  <!-- ADD NEW DOMAIN, SECTION START -->
  <div id="createNewAcceptedDomain" class="modal fade" tabindex="-1" aria-labelledby="createNewAcceptedDomainLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewAcceptedDomainLabel" class="modal-title">
            CREATE NEW ACCEPTED DOMAIN
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewAcceptedDomain" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="domain"
                     v-model="form.domain"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('domain') }"
                     class="form-control"
                     placeholder="Insert domain name"
                     name="domain"
              >
              <has-error :form="form" field="domain" />
            </div>
            <div class="col col-12 my-3">
              <input id="type"
                     v-model="form.type"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('type') }"
                     class="form-control"
                     placeholder="Insert domain type"
                     name="type"
              >
              <has-error :form="form" field="type" />
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
    <!-- ADD NEW DOMAIN, SECTION END -->
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
  name: 'NewAcceptedDomains',
  data: function () {
    return {
      form: new Form({
        domain: '',
        type: ''
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewAcceptedDomain () {
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
            this.form.domain = ''
            this.form.type = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/accepted-domains'
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.post(fullApiUrl, {
            domain: this.form.domain,
            type: this.form.type
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted domain name and type: ' + response.data.records.domain + ' (' + response.data.records.type + ')' + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.domain = ''
                this.form.type = ''
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
                  '<p>Inserted domain name and type: ' + this.form.domain + ' (' + this.form.type + ')' + '</p>'
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
                  '<p>Inserted domain name and type: ' + this.form.domain + ' (' + this.form.type + ')' + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
