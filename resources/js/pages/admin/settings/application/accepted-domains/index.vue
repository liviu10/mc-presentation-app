<template>
  <div class="lv-pg-admin-app-settings-section">
    <div class="lv-pg-admin-app-settings-section-body">
      <vue-good-table
        :columns="columns"
        :rows="displayListOfAcceptedDomains"
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
        <div v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'" slot="table-actions">
          <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#createNewAcceptedDomain">
            <fa icon="pencil-alt" fixed-width /> Add new
          </button>
        </div>
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'actions'">
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'"
                    class="btn btn-warning w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#editAcceptedDomain"
                    @click="editAcceptedDomain(props.row)"
            >
              <fa icon="edit" fixed-width /> Edit
            </button>
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'" class="btn btn-danger w-100" @click="deleteAcceptedDomain(props.row)">
              <fa icon="trash" fixed-width /> Delete
            </button>
          </span>
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>
      </vue-good-table>
    </div>

    <new-accepted-domains />

    <edit-accepted-domains :edit-row="selectedDataToEdit" />
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewAcceptedDomains from './new'
import EditAcceptedDomains from './edit'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminAcceptedDomains',
  components: {
    VueGoodTable,
    NewAcceptedDomains,
    EditAcceptedDomains
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
          label: 'Domain',
          field: 'domain'
        },
        {
          label: 'Type',
          field: 'type'
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false,
          tdClass: 'd-flex justify-content-center align-items-center',
          width: '180px'
        }
      ],
      selectedDataToEdit: {}
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfAcceptedDomains: 'accepted_domains/listOfAcceptedDomains'
    }),
    displayListOfAcceptedDomains () {
      return this.listOfAcceptedDomains.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfAcceptedDomains.http_response_code
    }
  },
  created () {
    this.fetchListOfAcceptedDomains()
  },
  methods: {
    ...mapActions({
      fetchListOfAcceptedDomains: 'accepted_domains/fetchListOfAcceptedDomains'
    }),
    async editAcceptedDomain (row) {
      this.selectedDataToEdit = row
      return this.selectedDataToEdit
    },
    async deleteAcceptedDomain (row) {
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
        const apiEndPoint = '/api/admin/system/accepted-domains'
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
                    '<p>Deleted domain name and type: ' + response.data.records.domain + ' (' + response.data.records.type + ')' + '</p>'
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
  }
}
</script>
