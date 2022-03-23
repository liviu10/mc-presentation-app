<template>
  <!-- ADD NEW USER, SECTION START -->
  <div id="createNewUser" class="modal fade" tabindex="-1" aria-labelledby="createNewUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewUserLabel" class="modal-title">
            CREATE NEW NEW USER
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewUser" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="name"
                     v-model="form.name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('name') }"
                     class="form-control"
                     placeholder="Insert user name"
                     name="name"
              >
              <has-error :form="form" field="name" />
            </div>
            <div class="col col-12 my-3">
              <input id="nickname"
                     v-model="form.nickname"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('nickname') }"
                     class="form-control"
                     placeholder="Insert user nickname"
                     name="nickname"
              >
              <has-error :form="form" field="nickname" />
            </div>
            <div class="col col-12 my-3">
              <input id="email"
                     v-model="form.email"
                     type="email"
                     :class="{ 'is-invalid': form.errors.has('email') }"
                     class="form-control"
                     placeholder="Insert user email"
                     name="email"
              >
              <has-error :form="form" field="email" />
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
    <!-- ADD NEW USER, SECTION END -->
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
  name: 'NewUser',
  data: function () {
    return {
      form: new Form({
        name: '',
        nickname: '',
        email: ''
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewUser () {
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
            this.form.name = ''
            this.form.nickname = ''
            this.form.email = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/user-list'
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.post(fullApiUrl, {
            name: this.form.name,
            nickname: this.form.nickname,
            email: this.form.email
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted user and email: ' + response.data.records.name + ' (' + response.data.records.email + ')' + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.name = ''
                this.form.nickname = ''
                this.form.email = ''
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
                  '<p>Inserted user and email: ' + this.form.name + ' (' + this.form.email + ')' + '</p>'
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
                  '<p>Inserted user and email: ' + this.form.name + ' (' + this.form.email + ')' + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
