<template>
  <!-- EDIT DOMAIN, SECTION START -->
  <div id="editAcceptedDomain" class="modal fade" tabindex="-1" aria-labelledby="editAcceptedDomainLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editAcceptedDomainLabel" class="modal-title">
            EDIT ACCEPTED DOMAIN
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="domain"
                     v-model="form.domain"
                     type="domain"
                     :class="{ 'is-invalid': form.errors.has('domain') }"
                     class="form-control"
                     :placeholder="editRow.domain"
                     name="domain"
              >
              <has-error :form="form" field="domain" />
            </div>
            <div class="col col-12 my-3">
              <input id="type"
                     v-model="form.type"
                     type="type"
                     :class="{ 'is-invalid': form.errors.has('type') }"
                     class="form-control"
                     :placeholder="editRow.type"
                     name="type"
              >
              <has-error :form="form" field="type" />
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
  <!-- EDIT DOMAIN, SECTION END -->
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
  name: 'EditAcceptedDomains',
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
        domain: this.editRow.domain,
        type: this.editRow.type
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
            this.form.domain = ''
            this.form.type = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/accepted-domains/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.put(fullApiUrl, {
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
        }
      }
    }
  }
}
</script>
