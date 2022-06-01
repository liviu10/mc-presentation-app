<template>
  <div class="row">
    <div class="col">
      <p class="card-text">
        Change newsletter welcome template
      </p>
      <p class="card-text">
        <button v-if="user.user_role_type_id === 1" class="btn btn-primary" type="button" @click="activateChangeNewsletterWelcomeTemplate()">
          Change
        </button>
      </p>
      <div v-if="hideNewsletterWelcomeTemplateForm === false">
        <form @submit.prevent="editNewsletterWelcomeTemplate" @keydown="form.onKeydown($event)">
          <div class="col col-12 my-3">
            <label class="form-label">Newsletter Welcome Template</label>
            <input id="name"
                   v-model="form.newsletter_welcome_template"
                   type="text"
                   :class="{ 'is-invalid': form.errors.has('newsletter_welcome_template') }"
                   class="form-control"
                   name="newsletter_welcome_template"
            >
            <has-error :form="form" field="newsletter_welcome_template" />
          </div>
          <div class="col col-12 my-3">
            <button type="submit" class="btn btn-primary">
              Update
            </button>
            <button class="btn btn-warning" @click="cancelNewsletterWelcomeTemplateChanges()">
              Cancel changes
            </button>
          </div>
        </form>
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
  name: 'AdminChangeNewsletterDay',
  middleware: 'auth',
  data: function () {
    return {
      form: new Form({
        newsletter_welcome_template: ''
      }),
      hideNewsletterWelcomeTemplateForm: true
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  methods: {
    activateChangeNewsletterWelcomeTemplate () {
      this.hideNewsletterWelcomeTemplateForm = false
    },
    cancelNewsletterWelcomeTemplateChanges () {
      this.hideNewsletterWelcomeTemplateForm = true
    },
    async editNewsletterWelcomeTemplate () {
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
            this.form.newsletter_sending_day = ''
          }
        })
      } else {
        try {
          const url = window.location.origin
          const apiEndPoint = '/api/admin/system/newsletter/change-welcome-template'
          const fullApiUrl = url + apiEndPoint
          await this.form
            .post(fullApiUrl, {
              newsletter_sending_day: this.form.newsletter_sending_day
            })
            .then((result) => {
              console.log(result)
              Swal.fire({
                title: result.title,
                html:
                '<p>Notify code: ' + '<a href="' + result.reference + '">' + result.notify_code + '</a>' + '</p>' +
                '<p>' + result.description + '</p>'
              }).then(
                (result) => {
                  if (result.isConfirmed) {
                    this.form.newsletter_sending_day = ''
                    this.hideNewsletterSendDayForm = true
                    window.location.reload()
                  }
                }
              )
            })
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
  }
}
</script>
