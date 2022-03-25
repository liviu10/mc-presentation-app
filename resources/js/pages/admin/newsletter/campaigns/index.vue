<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN NEWSLETTER CAMPAIGNS PAGE</h1>
        </div>
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
              perPage: 50,
              position: 'bottom',
              perPageDropdown: [100, 200, 300, 400, 500],
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
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createNewCampaign">
                <fa icon="pencil-alt" fixed-width />
              </button>
              <button class="btn btn-danger" @click="deleteAllCampaigns()">
                <fa icon="trash" fixed-width />
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'campaign_is_active'">
                <span v-if="props.row.campaign_is_active === '1'">Yes</span>
                <span v-else>No</span>
              </span>
              <span v-else-if="props.column.field == 'valid_from'">
                {{ new Date(props.row.valid_from).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'valid_to'">
                {{ new Date(props.row.valid_to).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editCampaign" @click="editCampaign(props.row)">
                  <fa icon="edit" fixed-width />
                </button>
                <button class="btn btn-danger" @click="deleteCampaign(props.row)">
                  <fa icon="trash" fixed-width />
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <new-campaign />

        <edit-campaign :edit-row="selectedDataToEdit" />
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewCampaign from './new'
import EditCampaign from './edit'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterCampaigns',
  components: {
    VueGoodTable,
    NewCampaign,
    EditCampaign
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
          label: 'Description',
          field: 'campaign_description'
        },
        {
          label: 'Active?',
          field: 'campaign_is_active'
        },
        {
          label: 'Valid from',
          field: 'valid_from'
        },
        {
          label: 'Valid to',
          field: 'valid_to'
        },
        {
          label: 'Created at',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions'
        }
      ],
      selectedDataToEdit: {}
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
  methods: {
    ...mapActions({
      fetchListOfCampaigns: 'newsletter_system/fetchListOfCampaigns'
    }),
    async editCampaign (row) {
      this.selectedDataToEdit = row
      return this.selectedDataToEdit
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
        try {
          await axios.delete(fullApiUrl, { id: urlParam })
            .then(response => {
              console.log('> response message: ')
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>' +
                    '<p>Deleted campaign name: ' + response.data.records.campaign_name + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                window.location.reload()
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
        try {
          await axios.delete(fullApiUrl)
            .then(response => {
              console.log('> response message: ')
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                window.location.reload()
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
    }
  },
  metaInfo () {
    return { title: 'Admin - Newsletter Campaign' }
  }
}
</script>
