<template>
  <div class="lv-pg-admin">
    <div class="lv-pg-admin-body">
      <div class="card">
        <div class="card-body">
          <admin-resend-newsletter />
          <admin-change-newsletter-day />
          <admin-change-newsletter-welcome-template />
          <admin-change-newsletter-template />
        </div>
      </div>
      <vue-good-table
        :columns="columns"
        :rows="displayNewsletterLogs"
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
          <span v-else-if="props.column.field == 'newsletter_subscriber'">
            {{ props.formattedRow[props.column.field].email }}
          </span>
          <span v-else-if="props.column.field == 'created_at'">
            {{ new Date(props.row.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
          </span>
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>
      </vue-good-table>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import AdminResendNewsletter from './resend-newsletter.vue'
import AdminChangeNewsletterDay from './change-newsletter-day.vue'
import AdminChangeNewsletterWelcomeTemplate from './change-newsletter-welcome-template.vue'
import AdminChangeNewsletterTemplate from './change-newsletter-template.vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminUserNewsletterSettings',
  components: {
    AdminResendNewsletter,
    AdminChangeNewsletterDay,
    AdminChangeNewsletterWelcomeTemplate,
    AdminChangeNewsletterTemplate,
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
          label: 'Campaign name',
          field: 'newsletter_campaign'
        },
        {
          label: 'Subscriber\'s email',
          field: 'newsletter_subscriber'
        },
        {
          label: 'Email status',
          field: 'email_status'
        },
        {
          label: 'Status date',
          field: 'created_at'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfNewsletterLogs: 'newsletter_system/listOfNewsletterLogs'
    }),
    displayNewsletterLogs () {
      return this.listOfNewsletterLogs.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfNewsletterLogs.http_response_code
    }
  },
  created () {
    this.fetchListOfNewsletterLogs()
  },
  methods: {
    ...mapActions({
      fetchListOfNewsletterLogs: 'newsletter_system/fetchListOfNewsletterLogs'
    })
  }
}
</script>
