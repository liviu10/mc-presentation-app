<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN APPLICATION LOGS PAGE</h1>
        </div>
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
              <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'created_at'">
                  {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                </span>
                <span v-else-if="props.column.field == 'actions'">
                  <button class="btn btn-primary" type="button" @click="actionOne()">
                    <fa icon="edit" fixed-width />
                  </button>
                  <button class="btn btn-danger" type="button" @click="actionTwo()">
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
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
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
          label: 'Model Id',
          field: 'logable_id'
        },
        {
          label: 'Related Model',
          field: 'logable_type'
        },
        {
          label: 'Status',
          field: 'status'
        },
        {
          label: 'Created at',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions'
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
    })
  },
  metaInfo () {
    return { title: 'Admin - Application Logs' }
  }
}
</script>
