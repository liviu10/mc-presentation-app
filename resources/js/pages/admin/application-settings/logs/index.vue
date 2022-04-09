<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <div class="lv-pg-admin-body">
            <vue-good-table
              :columns="columns"
              :rows="displayLogs"
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
              <div v-if="user.user_role_type_id === 1" slot="table-actions">
                <button class="btn btn-danger me-2" @click="deleteAllLogs()">
                  <fa icon="trash" fixed-width /> Delete all
                </button>
              </div>
              <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'created_at'">
                  {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
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
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import Vuex, { mapGetters, mapActions } from 'vuex'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterLogs',
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
          label: 'Status',
          field: 'status'
        },
        {
          label: 'Details',
          field: 'details'
        },
        {
          label: 'Created at',
          field: 'created_at'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfLogs: 'logs/listOfLogs'
    }),
    displayLogs () {
      return this.listOfLogs.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfLogs.http_response_code
    }
  },
  created () {
    this.fetchListOfLogs()
  },
  methods: {
    ...mapActions({
      fetchListOfLogs: 'logs/fetchListOfLogs'
    }),
    async deleteAllLogs () {
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
        const apiEndPoint = '/api/admin/system/delete-all-logs'
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
          if (err.response.status === 404) {
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
