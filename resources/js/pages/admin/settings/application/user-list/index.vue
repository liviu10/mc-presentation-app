<template>
  <div class="lv-pg-admin-app-settings-section">
    <div class="lv-pg-admin-app-settings-section-body">
      <vue-good-table
        :columns="columns"
        :rows="displayListOfUsers"
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
          <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#createNewUser">
            <fa icon="pencil-alt" fixed-width /> Add new
          </button>
        </div>
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'user_role_type_id'">
            {{ props.row.user_role_type.user_role_name }}
          </span>
          <span v-else-if="props.column.field == 'created_at'">
            {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
          </span>
          <span v-else-if="props.column.field == 'actions'">
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'"
                    class="btn btn-warning w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#editUser"
                    @click="editUser(props.row)"
            >
              <fa icon="edit" fixed-width /> Edit
            </button>
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'" class="btn btn-danger w-100" @click="deleteUsers(props.row)">
              <fa icon="trash" fixed-width /> Delete
            </button>
          </span>
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>
      </vue-good-table>
    </div>

    <new-user />

    <edit-user :edit-row="selectedDataToEdit" />
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewUser from './new'
import EditUser from './edit'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminUserList',
  components: {
    VueGoodTable,
    NewUser,
    EditUser
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
          field: 'name'
        },
        {
          label: 'Nickname',
          field: 'nickname'
        },
        {
          label: 'Email',
          field: 'email'
        },
        {
          label: 'User Role',
          field: 'user_role_type_id'
        },
        {
          label: 'Joined at',
          field: 'created_at'
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
      listOfUsers: 'user_list/listOfUsers'
    }),
    displayListOfUsers () {
      return this.listOfUsers.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfUsers.http_response_code
    }
  },
  created () {
    this.fetchListOfUsers()
  },
  methods: {
    ...mapActions({
      fetchListOfUsers: 'user_list/fetchListOfUsers'
    }),
    async editUser (row) {
      this.selectedDataToEdit = row
      return this.selectedDataToEdit
    },
    async deleteUsers (row) {
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
        const apiEndPoint = '/api/admin/system/user-list'
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
                    '<p>Deleted user and email: ' + response.data.records.name + ' (' + response.data.records.email + ')' + '</p>'
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
