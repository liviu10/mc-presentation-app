<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-booking">
        <div class="lv-con-pg-booking-title">
          <h1>BOOKING APPOINTMENT PAGE</h1>
        </div>
        <div class="lv-con-pg-booking-body">
          TEST
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'BookingPage',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {}
  },
  computed: {},
  mounted () {},
  methods: {},
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
