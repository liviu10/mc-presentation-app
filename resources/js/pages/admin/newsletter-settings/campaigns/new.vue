<template>
  <!-- ADD NEW CAMPAIGN, SECTION START -->
  <div id="createNewCampaign" class="modal fade" tabindex="-1" aria-labelledby="createNewCampaignLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="createNewCampaignLabel" class="modal-title">
            Create a new campaign
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <form @submit.prevent="createNewCampaign" @keydown="form.onKeydown($event)">
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Campaign name
              </label>
              <input id="campaign_name"
                     v-model="form.campaign_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('campaign_name') }"
                     class="form-control"
                     name="campaign_name"
              >
              <has-error :form="form" field="campaign_name" />
            </div>
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Campaign description
              </label>
              <textarea id="campaign_description"
                        v-model="form.campaign_description"
                        type="text"
                        :class="{ 'is-invalid': form.errors.has('campaign_description') }"
                        class="form-control"
                        name="campaign_description"
                        rows="8"
                        style="resize:none"
              />
              <has-error :form="form" field="campaign_description" />
            </div>
            <div class="col col-12 my-3">
              <label class="col-form-label">
                Activate campaign?
              </label>
              <select id="campaign_is_active"
                      v-model="form.campaign_is_active"
                      class="form-select"
                      :class="{ 'is-invalid': form.errors.has('campaign_is_active') }"
                      name="campaign_is_active"
                      aria-label="Default select example"
              >
                <option value="1">
                  Yes
                </option>
                <option value="2">
                  No
                </option>
              </select>
              <has-error :form="form" field="campaign_is_active" />
            </div>
            <div class="row my-3">
              <label class="col-form-label">
                Select campaign valid from and end date
              </label>
              <div class="col col-6">
                <input id="valid_from"
                       v-model="form.valid_from"
                       type="date"
                       :class="{ 'is-invalid': form.errors.has('valid_from') }"
                       class="form-control"
                       name="valid_from"
                >
                <has-error :form="form" field="valid_from" />
              </div>
              <div class="col col-6">
                <input id="valid_to"
                       v-model="form.valid_to"
                       type="date"
                       :class="{ 'is-invalid': form.errors.has('valid_to') }"
                       class="form-control"
                       name="valid_to"
                >
                <has-error :form="form" field="valid_to" />
              </div>
            </div>
            <div class="row my-3">
              <label class="col-form-label">
                Occur every
              </label>
              <div class="col col-6">
                <input id="occur_times"
                       v-model="form.occur_times"
                       type="number"
                       :class="{ 'is-invalid': form.errors.has('occur_times') }"
                       class="form-control"
                       name="occur_times"
                       min="1"
                       step="1"
                >
                <has-error :form="form" field="occur_times" />
              </div>
              <div class="col col-6">
                <select id="occur_when"
                        v-model="form.occur_when"
                        class="form-select"
                        :class="{ 'is-invalid': form.errors.has('occur_when') }"
                        name="occur_when"
                        aria-label="Default select example"
                >
                  <option value="1">
                    Day
                  </option>
                  <option value="2">
                    Week
                  </option>
                  <option value="3">
                    Odd Week
                  </option>
                  <option value="4">
                    Even Week
                  </option>
                  <option value="5">
                    Month
                  </option>
                </select>
                <has-error :form="form" field="occur_when" />
              </div>
              <div class="col col-6 mt-2">
                <select id="occur_day"
                        v-model="form.occur_day"
                        class="form-select"
                        :class="{ 'is-invalid': form.errors.has('occur_day') }"
                        name="occur_day"
                        aria-label="Default select example"
                >
                  <option value="1">
                    Monday
                  </option>
                  <option value="2">
                    Tuesday
                  </option>
                  <option value="3">
                    Wednesday
                  </option>
                  <option value="4">
                    Thursday
                  </option>
                  <option value="5">
                    Friday
                  </option>
                  <option value="6">
                    Saturday
                  </option>
                  <option value="7">
                    Sunday
                  </option>
                </select>
                <has-error :form="form" field="occur_day" />
              </div>
              <div class="col col-6 mt-2">
                <input id="occur_hour"
                       v-model="form.occur_hour"
                       type="time"
                       :class="{ 'is-invalid': form.errors.has('occur_hour') }"
                       class="form-control"
                       name="occur_hour"
                       min="00:00"
                       max="23:59"
                >
                <has-error :form="form" field="occur_hour" />
              </div>
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
    <!-- ADD NEW CAMPAIGN, SECTION END -->
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
        campaign_name: '',
        campaign_description: '',
        campaign_is_active: '',
        valid_from: '',
        valid_to: '',
        occur_times: 1,
        occur_when: '2',
        occur_day: '3',
        occur_hour: '12:00'
      }),
      showNotificationMessage: false
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async createNewCampaign () {
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
            this.form.occur_times = ''
            this.form.occur_when = ''
            this.form.occur_day = ''
            this.form.occur_hour = ''
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/newsletter/campaigns'
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.post(fullApiUrl, {
            campaign_name: this.form.campaign_name,
            campaign_description: this.form.campaign_description,
            campaign_is_active: this.form.campaign_is_active,
            valid_from: this.form.valid_from,
            valid_to: this.form.valid_to,
            occur_times: this.form.occur_times,
            occur_when: this.form.occur_when,
            occur_day: this.form.occur_day,
            occur_hour: this.form.occur_hour
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
                this.form.occur_times = ''
                this.form.occur_when = ''
                this.form.occur_day = ''
                this.form.occur_hour = ''
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
                  '<p>Inserted campaign name: ' + this.form.campaign_name + '</p>'
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
                  '<p>Inserted campaign name: ' + this.form.campaign_name + '</p>'
            })
          }
        }
      }
    }
  }
}
</script>
