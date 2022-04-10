<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayNewsletterCampaigns"
            :search-options="{
              enabled: true
            }"
            :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 15,
              position: 'bottom',
              perPageDropdown: [30, 45, 60, 'All'],
              dropdownAllowAll: false,
              setCurrentPage: 1,
              jumpFirstOrLast : true,
              firstLabel : 'First Page',
              lastLabel : 'Last Page',
              nextLabel: 'next',
              prevLabel: 'prev',
              rowsPerPageLabel: 'Rows per page',
              ofLabel: 'of',
              pageLabel: 'page',
              allLabel: 'All',
            }"
          >
            <div slot="table-actions">
              <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createNewCampaign">
                <fa icon="pencil-alt" fixed-width /> Add new
              </button>
              <button v-if="user.user_role_type_id === 1" class="btn btn-danger me-2" @click="deleteAllCampaigns()">
                <fa icon="trash" fixed-width /> Delete all
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'campaign_is_active'">
                <span v-if="props.formattedRow[props.column.field] === '1'">
                  Yes
                </span>
                <span v-else>
                  No
                </span>
              </span>
              <span v-else-if="props.column.field == 'valid_from'">
                {{ new Date(props.formattedRow['valid_from']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'valid_to'">
                {{ new Date(props.formattedRow['valid_to']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'occurrence_times'">
                <span v-if="props.formattedRow['occur_times'] && props.formattedRow['occur_when']">
                  {{ props.formattedRow['occur_times'] }} times per
                  <span v-if="props.formattedRow['occur_when'] === '1'">
                    Day
                  </span>
                  <span v-else-if="props.formattedRow['occur_when'] === '2'">
                    Week
                  </span>
                  <span v-else>
                    Month
                  </span>
                </span>
                <span v-else>
                  &#8212;
                </span>
              </span>
              <span v-else-if="props.column.field == 'occurrence_moment'">
                <span v-if="props.formattedRow['occur_day'] && props.formattedRow['occur_hour']">
                  <span v-if="props.formattedRow['occur_day'] === '1'">
                    Monday
                  </span>
                  <span v-else-if="props.formattedRow['occur_day'] === '2'">
                    Tuesday
                  </span>
                  <span v-else-if="props.formattedRow['occur_day'] === '3'">
                    Wednesday
                  </span>
                  <span v-else-if="props.formattedRow['occur_day'] === '4'">
                    Thursday
                  </span>
                  <span v-else-if="props.formattedRow['occur_day'] === '5'">
                    Friday
                  </span>
                  <span v-else-if="props.formattedRow['occur_day'] === '6'">
                    Saturday
                  </span>
                  <span v-else>
                    Sunday,
                  </span>
                  at
                  <span>
                    {{ props.formattedRow['occur_hour'] }}
                  </span>
                </span>
                <span v-else>
                  &#8212;
                </span>
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-info w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#showCampaign"
                        @click="showCampaign(props.row)"
                >
                  <fa icon="eye" fixed-width /> Show
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-warning w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#editCampaign"
                        @click="editCampaign(props.row)"
                >
                  <fa icon="edit" fixed-width /> Edit
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-danger w-100"
                        @click="deleteCampaign(props.row)"
                >
                  <fa icon="trash" fixed-width /> Delete
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <new-campaign />

        <show-campaign :show-row="selectedData" />

        <!-- EDIT CAMPAIGN, SECTION START -->
        <div id="editCampaign"
             class="modal fade"
             tabindex="-1"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             aria-labelledby="editCampaignLabel"
             aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="editCampaignLabel" class="modal-title">
                  Edit "{{ selectedData.campaign_name }}" newsletter campaign
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
              </div>
              <div class="modal-body">
                <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
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
        </div>
        <!-- EDIT CAMPAIGN, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import Form from 'vform'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewCampaign from './new'
import ShowCampaign from './show'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterCampaigns',
  components: {
    VueGoodTable,
    NewCampaign,
    ShowCampaign
  },
  middleware: 'auth',
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Name',
          field: 'campaign_name'
        },
        {
          label: 'Active?',
          field: 'campaign_is_active'
        },
        {
          label: 'Valid period',
          field: 'valid_period',
          hidden: true
        },
        {
          label: 'Valid from',
          field: 'valid_from',
          hidden: false
        },
        {
          label: 'Valid to',
          field: 'valid_to',
          hidden: false
        },
        {
          label: 'Number of occurrences in selected period',
          field: 'occurrence_times'
        },
        {
          label: 'Occurrence',
          field: 'occur_times',
          hidden: true
        },
        {
          label: 'Valid to',
          field: 'occur_when',
          hidden: true
        },
        {
          label: 'Occurrence day and time',
          field: 'occurrence_moment'
        },
        {
          label: 'Valid to',
          field: 'occur_day',
          hidden: true
        },
        {
          label: 'Valid to',
          field: 'occur_hour',
          hidden: true
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false
        }
      ],
      selectedData: {},
      form: new Form({
        campaign_name: '',
        campaign_description: '',
        campaign_is_active: '',
        valid_from: '',
        valid_to: '',
        occur_times: '',
        occur_when: '',
        occur_day: '',
        occur_hour: ''
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfCampaigns: 'newsletter_system/listOfCampaigns'
    }),
    displayNewsletterCampaigns () {
      return this.listOfCampaigns.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfCampaigns.http_response_code
    }
  },
  created () {
    this.fetchListOfCampaigns()
  },
  updated () {
    this.emitToParentCampaignList()
  },
  methods: {
    ...mapActions({
      fetchListOfCampaigns: 'newsletter_system/fetchListOfCampaigns'
    }),
    async showCampaign (row) {
      this.selectedData = row
      return this.selectedData
    },
    async editCampaign (row) {
      this.selectedData = row
      this.form.campaign_name = this.selectedData.campaign_name
      this.form.campaign_description = this.selectedData.campaign_description
      this.form.campaign_is_active = this.selectedData.campaign_is_active
      this.form.valid_from = this.selectedData.valid_from
      this.form.valid_to = this.selectedData.valid_to
      this.form.occur_times = this.selectedData.occur_times
      this.form.occur_when = this.selectedData.occur_when
      this.form.occur_day = this.selectedData.occur_day
      this.form.occur_hour = this.selectedData.occur_hour
      return this.selectedData
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
        const apiEndPoint = '/api/admin/system/newsletter/campaigns/'
        const urlParam = this.selectedData.id
        const fullApiUrl = url + apiEndPoint + urlParam
        try {
          await this.form.put(fullApiUrl, {
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
                  '<p>Inserted campaign name: ' + this.form.campaign + '</p>'
            })
          }
        }
      }
    },
    async deleteCampaign (row) {
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
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/newsletter/campaigns'
        const urlParam = row.id
        const fullApiUrl = url + apiEndPoint + '/' + urlParam
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            try {
              axios.delete(fullApiUrl, { id: urlParam })
                .then((results) => {
                  console.log('> response message: ')
                  Swal.fire({
                    title: results.data.title,
                    html:
                            '<p>Notify code: ' + '<a href="' + results.data.reference + '">' + results.data.notify_code + '</a>' + '</p>' +
                            '<p>' + results.data.description + '</p>' +
                            '<p>Deleted campaign name: ' + results.data.records.campaign_name + '</p>'
                  }).then((results) => {
                    if (result.isConfirmed) {
                      console.log('> result message: ')
                      window.location.reload()
                    }
                  })
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
            }
          }
        })
      }
    },
    async deleteAllCampaigns () {
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
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/newsletter/campaigns/delete-all'
        const fullApiUrl = url + apiEndPoint
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            try {
              axios.delete(fullApiUrl)
                .then(response => {
                  console.log('> response message: ')
                  Swal.fire({
                    title: response.data.title,
                    html:
                        '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                        '<p>' + response.data.description + '</p>'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      console.log('> result message: ')
                      window.location.reload()
                    }
                  })
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
            }
          }
        })
      }
    },
    emitToParentCampaignList (event) {
      this.$emit('campaign-list', this.displayNewsletterCampaigns)
    }
  }
}
</script>
