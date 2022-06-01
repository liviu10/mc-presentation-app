<template>
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
        <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'newsletter_campaign'">
            {{ props.formattedRow[props.column.field].campaign_name }}
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
          <span v-else-if="props.column.field == 'actions'">
            <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                    class="btn btn-info w-100"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#setNewCampaign"
                    @click="setNewCampaigns(props.row)"
            >
              <fa icon="eye" fixed-width /> Set campaign(s)
            </button>
          </span>
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>
      </vue-good-table>
    </div>

    <set-new-campaign :show-row="selectedData" :campaign-details="campaignName" />
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import SetNewCampaign from './set-new-campaign'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminUserNewsletterSubscribers',
  components: {
    VueGoodTable,
    SetNewCampaign
  },
  middleware: 'auth',
  props: {
    campaignName: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Campaign name',
          field: 'newsletter_campaign'
        },
        {
          label: 'Full name',
          field: 'full_name'
        },
        {
          label: 'Email address',
          field: 'email'
        },
        {
          label: 'Subscribed at',
          field: 'created_at'
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false
        }
      ],
      selectedData: {}
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
    setNewCampaigns (row) {
      this.selectedData = row
      return this.selectedData
    }
  }
}
</script>
