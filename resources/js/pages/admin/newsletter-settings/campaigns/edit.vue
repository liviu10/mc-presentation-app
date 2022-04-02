<template>
  <!-- EDIT CAMPAIGN, SECTION START -->
  <div id="editCampaign" class="modal fade" tabindex="-1" aria-labelledby="editCampaignLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editCampaignLabel" class="modal-title">
            EDIT USER
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <input id="campaign_name"
                     v-model="form.campaign_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('campaign_name') }"
                     class="form-control"
                     :placeholder="editRow.campaign_name"
                     name="campaign_name"
              >
              <has-error :form="form" field="campaign_name" />
            </div>
            <div class="col col-12 my-3">
              <input id="campaign_description"
                     v-model="form.campaign_description"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('campaign_description') }"
                     class="form-control"
                     :placeholder="editRow.campaign_description"
                     name="campaign_description"
              >
              <has-error :form="form" field="campaign_description" />
            </div>
            <div class="col col-12 my-3">
              <input id="campaign_is_active"
                     v-model="form.campaign_is_active"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('campaign_is_active') }"
                     class="form-control"
                     :placeholder="editRow.campaign_is_active"
                     name="campaign_is_active"
              >
              <has-error :form="form" field="campaign_is_active" />
            </div>
            <div class="col col-12 my-3">
              <input id="valid_from"
                     v-model="form.valid_from"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('valid_from') }"
                     class="form-control"
                     :placeholder="editRow.valid_from"
                     name="valid_from"
              >
              <has-error :form="form" field="valid_from" />
            </div>
            <div class="col col-12 my-3">
              <input id="valid_to"
                     v-model="form.valid_to"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('valid_to') }"
                     class="form-control"
                     :placeholder="editRow.valid_to"
                     name="valid_to"
              >
              <has-error :form="form" field="valid_to" />
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
  name: 'EditCampaign',
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
        campaign_name: this.editRow.campaign_name,
        campaign_description: this.editRow.campaign_description,
        campaign_is_active: this.editRow.campaign_is_active,
        valid_from: this.editRow.valid_from,
        valid_to: this.editRow.valid_to
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
            this.form.campaign_name = ''
            this.form.campaign_description = ''
            this.form.campaign_is_active = ''
            this.form.valid_from = ''
            this.form.valid_to = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/newsletter/campaigns/' + this.editRow.id
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.put(fullApiUrl, {
            campaign_name: this.form.campaign_name,
            campaign_description: this.form.campaign_description,
            campaign_is_active: this.form.campaign_is_active,
            valid_from: this.form.valid_from,
            valid_to: this.form.valid_to
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Inserted campaign name: ' + response.data.records.campaign_name + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.campaign_name = ''
                this.form.campaign_description = ''
                this.form.campaign_is_active = ''
                this.form.valid_from = ''
                this.form.valid_to = ''
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
                  '<p>Inserted campaign name: ' + this.form.campaign + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
