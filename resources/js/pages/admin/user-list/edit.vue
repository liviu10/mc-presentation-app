<template>
  <!-- EDIT USER, SECTION START -->
  <div id="editUser" class="modal fade" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editUserLabel" class="modal-title">
            EDIT USER
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="name"
                     v-model="form.name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('name') }"
                     class="form-control"
                     :placeholder="editRow.name"
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
                     :placeholder="editRow.nickname"
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
                     :placeholder="editRow.email"
                     name="email"
              >
              <has-error :form="form" field="email" />
            </div>
            <div class="col col-12 my-3">
              <input id="user_role_type_id"
                     v-model="form.user_role_type_id"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('user_role_type_id') }"
                     class="form-control"
                     :placeholder="editRow.user_role_type_id"
                     name="user_role_type_id"
              >
              <has-error :form="form" field="user_role_type_id" />
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
  <!-- EDIT USER, SECTION END -->
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
  name: 'EditUser',
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
        name: this.editRow.name,
        nickname: this.editRow.nickname,
        email: this.editRow.email,
        user_role_type_id: this.editRow.user_role_type_id
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
            this.form.name = ''
            this.form.nickname = ''
            this.form.email = ''
            this.form.user_role_type_id = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/accepted-domains/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.put(fullApiUrl, {
            name: this.form.name,
            nickname: this.form.nickname,
            email: this.form.email,
            user_role_type_id: this.form.user_role_type_id
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
                this.form.user_role_type_id = ''
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
        }
      }
    }
  }
}
</script>
