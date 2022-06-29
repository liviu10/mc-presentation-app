<template>
  <div class="lv-pg-admin-app-settings-section">
    <div class="lv-pg-admin-app-settings-section-body">
      <vue-good-table
        :columns="columns"
        :rows="displayListOfErrorsAndNotifications"
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
          <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#createErrorAndNotification">
            <fa icon="pencil-alt" fixed-width /> Add new
          </button>
        </div>
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'notify_reference'">
            <a :href="props.row.notify_reference" target="_blank">{{ props.row.notify_code }}</a>
          </span>
          <span v-else-if="props.column.field == 'actions'">
            <button v-if="user.user_role_type_id == '1' || user.user_role_type_id == '2'"
                    class="btn btn-warning w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#editErrorAndNotification"
                    @click="editErrorAndNotification(props.row)"
            >
              <fa icon="edit" fixed-width /> Edit
            </button>
          </span>
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>
      </vue-good-table>

      <new-error-and-notification />

      <edit-error-and-notification :edit-row="selectedDataToEdit" />
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import NewErrorAndNotification from './new'
import EditErrorAndNotification from './edit'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminErrorsAndNotifications',
  components: {
    VueGoodTable,
    NewErrorAndNotification,
    EditErrorAndNotification
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
          label: 'Notify Code',
          field: 'notify_code'
        },
        {
          label: 'Notify Description',
          field: 'notify_short_description'
        },
        {
          label: 'Notify Reference',
          field: 'notify_reference'
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
      listOfErrorsAndNotifications: 'errors_and_notifications/listOfErrorsAndNotifications'
    }),
    displayListOfErrorsAndNotifications () {
      return this.listOfErrorsAndNotifications.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfErrorsAndNotifications.http_response_code
    }
  },
  created () {
    this.fetchListOfErrorsAndNotifications()
  },
  methods: {
    ...mapActions({
      fetchListOfErrorsAndNotifications: 'errors_and_notifications/fetchListOfErrorsAndNotifications'
    }),
    async editErrorAndNotification (errorAndNotification) {
      this.selectedDataToEdit = errorAndNotification
      return this.selectedDataToEdit
    }
  }
}
</script>
