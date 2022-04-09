<template>
  <!-- SET NEW CAMPAIGNS, SECTION START -->
  <div id="setNewCampaign" class="modal fade" tabindex="-1" aria-labelledby="setNewCampaignLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="setNewCampaignLabel" class="modal-title">
            Set up newsletter campaigns for {{ showRow.full_name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <form @submit.prevent="setNewCampaign" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <ul class="list-group">
              <li class="list-group-item">
                <div class="col col-12 my-3">
                  <label class="col-form-label">
                    <b>Campaign name:</b>
                  </label>
                  <select id="new_campaigns"
                          v-model="form.new_campaigns"
                          class="form-select"
                          :class="{ 'is-invalid': form.errors.has('new_campaigns') }"
                          name="new_campaigns"
                          aria-label="Default select example"
                          style="height: 300px"
                          multiple
                  >
                    <optgroup v-for="item in campaignDetails" :key="item.id" label="Campaign details">
                      <option :value="item.id">
                        Campaign title: {{ item.campaign_name }}
                      </option>
                      <option disabled>
                        Campaign status:
                        <span v-if="item.campaign_is_active === '1'">
                          active
                        </span>
                        <span v-else>
                          inactive
                        </span>
                      </option>
                      <option disabled>
                        Valid period:
                        {{ new Date(item.valid_from).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                        &#8212;
                        {{ new Date(item.valid_to).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                      </option>
                      <option disabled>
                        <span v-if="item.occur_times && item.occur_when && item.occur_day && item.occur_hour">
                          {{ item.occur_times }} times per
                          <span v-if="item.occur_when === '1'">
                            Day,
                          </span>
                          <span v-else-if="item.occur_when === '2'">
                            Week,
                          </span>
                          <span v-else>
                            Month,
                          </span>
                          on
                          <span v-if="item.occur_day === '1'">
                            Monday
                          </span>
                          <span v-else-if="item.occur_day === '2'">
                            Tuesday
                          </span>
                          <span v-else-if="item.occur_day === '3'">
                            Wednesday
                          </span>
                          <span v-else-if="item.occur_day === '4'">
                            Thursday
                          </span>
                          <span v-else-if="item.occur_day === '5'">
                            Friday
                          </span>
                          <span v-else-if="item.occur_day === '6'">
                            Saturday
                          </span>
                          <span v-else>
                            Sunday,
                          </span>
                          at
                          <span>
                            {{ item.occur_hour }}
                          </span>
                        </span>
                        <span v-else>
                          &#8212;
                        </span>
                      </option>
                    </optgroup>
                  </select>
                  <has-error :form="form" field="campaign_is_active" />
                </div>
              </li>
              <li class="list-group-item">
                <b>User's full name:</b>
                {{ showRow.full_name }}
              </li>
              <li class="list-group-item">
                <b>User's email address:</b>
                {{ showRow.email }}
              </li>
              <li class="list-group-item">
                <b>Status:</b>
                <span v-if="showRow.privacy_policy === '1'">
                  User accepted the privacy policy
                </span>
                <span v-else>
                  User did not accepted the privacy policy
                </span>
              </li>
              <li class="list-group-item">
                <b>Subscribed at:</b>
                {{ new Date(showRow.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </li>
            </ul>
          </div>
          <div class="modal-buttons mx-3 my-2">
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
  <!-- SET NEW CAMPAIGNS, SECTION END -->
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
  name: 'SetNewCampaign',
  middleware: 'auth',
  props: {
    showRow: {
      default: null,
      type: Object
    },
    campaignDetails: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      form: new Form({
        new_campaigns: {}
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  methods: {
    async setNewCampaign () {
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
