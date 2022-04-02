<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <div class="row">
            <div class="col">
              {{ displayStatistics["Numărul total de campanii: "] }}
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    CAMPAIGN & NEWSLETTER STATISTICS:
                    <a href="">
                      Check documentation
                    </a>
                  </h5>
                  <p v-for="kpi in displayNewsletterReportKpi" :key="kpi.id" class="card-text">
                    {{ kpi.kpi_name }}:
                  </p>
                </div>
              </div>
            </div>
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

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminNewsletterReports',
  middleware: 'auth',
  computed: {
    ...mapGetters({
      user: 'auth/user',
      newsletterReportKpi: 'newsletter_system/newsletterReportKpi',
      statistics: 'newsletter_system/statistics'
    }),
    displayNewsletterReportKpi () {
      return this.newsletterReportKpi.records
    },
    displayStatistics () {
      return this.statistics.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.newsletterReportKpi.http_response_code
    }
  },
  created () {
    this.fetchNewsletterReportKpi()
    this.fetchStatistics()
  },
  methods: {
    ...mapActions({
      fetchNewsletterReportKpi: 'newsletter_system/fetchNewsletterReportKpi',
      fetchStatistics: 'newsletter_system/fetchStatistics'
    })
  }
}
</script>
