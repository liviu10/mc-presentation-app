<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
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
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'privacy_policy'">
                <span v-if="props.row.privacy_policy === '1'">Yes</span>
                <span v-else>No</span>
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'unsubscribed_at'">
                <span v-if="props.row.unsubscribed_at === null" />
                <span v-else>
                  {{ new Date(props.row.unsubscribed_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                </span>
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
    })
  }
}
</script>
