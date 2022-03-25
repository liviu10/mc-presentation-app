<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN NEWSLETTER SUBSCRIBERS PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayNewsletterSubscribers"
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
              <button class="btn btn-danger" @click="deleteAllSubscribers()">
                <fa icon="trash" fixed-width />
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'privacy_policy'">
                <span v-if="props.row.privacy_policy === '1'">Yes</span>
                <span v-else>No</span>
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'unsubscribed_at'">
                {{ new Date(props.row.unsubscribed_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button class="btn btn-primary" type="button" @click="actionOne()">
                  <fa icon="edit" fixed-width />
                </button>
                <button class="btn btn-danger" @click="deleteSubscriber(props.row)">
                  <fa icon="trash" fixed-width />
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>
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

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterSubscribers',
  components: {
    VueGoodTable
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
          label: 'Newsletter Campaign',
          field: 'newsletter_campaign_id'
        },
        {
          label: 'Full name',
          field: 'full_name'
        },
        {
          label: 'Email',
          field: 'email'
        },
        {
          label: 'Privacy policy',
          field: 'privacy_policy'
        },
        {
          label: 'Created at',
          field: 'created_at'
        },
        {
          label: 'Unsubscribed at',
          field: 'unsubscribed_at'
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
      listOfSubscribers: 'newsletter_system/listOfSubscribers'
    }),
    displayNewsletterSubscribers () {
      return this.listOfSubscribers.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfSubscribers.http_response_code
    }
  },
  created () {
    this.fetchListOfSubscribers()
  },
  methods: {
    ...mapActions({
      fetchListOfSubscribers: 'newsletter_system/fetchListOfSubscribers'
    }),
    async editSubscriber (row) {
      this.selectedDataToEdit = row
      return this.selectedDataToEdit
    },
    async deleteSubscriber (row) {
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
        const apiEndPoint = '/api/admin/system/newsletter/subscribers'
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
                    '<p>Deleted subscriber\'s name: ' + response.data.records.full_name + '</p>'
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
    async deleteAllSubscribers () {
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
        const apiEndPoint = '/api/admin/system/newsletter/subscribers/delete-all'
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
    return { title: 'Admin - Newsletter Subscribers' }
  }
}
</script>
