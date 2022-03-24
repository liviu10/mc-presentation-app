<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN PROFILE SETTINGS PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Profile
              </h5>
              <div class="card-text">
                <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
                  <div class="col col-12 my-3">
                    <label class="form-label">Name</label>
                    <input id="name"
                           v-model="form.name"
                           type="text"
                           :class="{ 'is-invalid': form.errors.has('name') }"
                           class="form-control"
                           name="name"
                           :disabled="disableNameField"
                    >
                    <has-error :form="form" field="name" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="form-label">Email</label>
                    <input id="email"
                           v-model="form.email"
                           type="text"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           class="form-control"
                           name="email"
                           :disabled="disableEmailField"
                    >
                    <has-error :form="form" field="email" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="form-label">Nickname</label>
                    <input id="nickname"
                           v-model="form.nickname"
                           type="text"
                           :class="{ 'is-invalid': form.errors.has('nickname') }"
                           class="form-control"
                           name="nickname"
                           :disabled="disableNicknameField"
                    >
                    <has-error :form="form" field="nickname" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="form-label">Password</label>
                    <input id="password"
                           v-model="form.password"
                           type="password"
                           :class="{ 'is-invalid': form.errors.has('password') }"
                           class="form-control"
                           name="password"
                           :disabled="disablePasswordField"
                    >
                    <has-error :form="form" field="password" />
                  </div>
                  <div class="col col-12 my-3">
                    <label class="form-label">Confirm Password</label>
                    <input id="password_confirmation"
                           v-model="form.password_confirmation"
                           type="password"
                           :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                           class="form-control"
                           name="password_confirmation"
                           :disabled="disablePasswordConfirmationField"
                    >
                    <has-error :form="form" field="password_confirmation" />
                  </div>
                  <div class="modal-buttons">
                    <button type="submit" class="btn btn-primary" :hidden="hideUpdateButton">
                      Update
                    </button>
                  </div>
                </form>
                <div class="modal-buttons">
                  <button class="btn btn-primary" :hidden="hideActivateChangesButton" @click="activateChanges()">
                    Activate changes
                  </button>
                  <button v-if="hideActivateChangesButton === true" class="btn btn-warning" @click="cancelChanges()">
                    Cancel changes
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters } from 'vuex'
import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminProfileSettings',
  middleware: 'auth',
  data: function () {
    return {
      form: new Form({
        name: '',
        email: '',
        nickname: '',
        password: '',
        password_confirmation: ''
      }),
      disableNameField: true,
      disableEmailField: true,
      disableNicknameField: true,
      disablePasswordField: true,
      disablePasswordConfirmationField: true,
      hideUpdateButton: true,
      hideActivateChangesButton: false
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  created () {
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },
  methods: {
    activateChanges () {
      this.hideActivateChangesButton = true
      this.disableNameField = false
      this.disableNicknameField = false
      this.disablePasswordField = false
      this.disablePasswordConfirmationField = false
      this.hideUpdateButton = false
    },
    cancelChanges () {
      this.hideActivateChangesButton = false
      this.disableNameField = true
      this.disableNicknameField = true
      this.disablePasswordField = true
      this.disablePasswordConfirmationField = true
      this.hideUpdateButton = true
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
            this.form.name = ''
            this.form.email = ''
            this.form.nickname = ''
            this.form.password = ''
            this.form.password_confirmation = ''
          }
        })
      } else {
        try {
          const { data } = await this.form.patch('/api/settings/profile')
          this.$store.dispatch('auth/updateUser', { user: data })
          Swal.fire({
            title: data.title,
            html:
                '<p>Notify code: ' + '<a href="' + data.reference + '">' + data.notify_code + '</a>' + '</p>' +
                '<p>' + data.description + '</p>'
          }).then(
            (result) => {
              if (result.isConfirmed) {
                this.hideActivateChangesButton = false
                this.disableNameField = true
                this.disableNicknameField = true
                this.disablePasswordField = true
                this.disablePasswordConfirmationField = true
                this.hideUpdateButton = true
                window.location.reload()
              }
            }
          )
        } catch (err) {
          if (err.response.status === 500) {
            console.log('> error message: ')
            Swal.fire({
              title: err.response.data.title,
              html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>'
            })
          }
          if (err.response.status === 406) {
            console.log('> error message: ')
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
  },
  metaInfo () {
    return { title: 'Admin - Profile Settings' }
  }
}
</script>
