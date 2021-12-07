<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-questionnaire">
        <div class="lv-con-pg-questionnaire-title">
          <h1>Relatia dintre emotii si muzica</h1>
        </div>
        <div class="lv-con-pg-questionnaire-body">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                1. Ce te face pe tine fericit/fericita?*
              </h5>
              <img src="/images/questionnaire/question1.jpg" class="card-img-top" alt="...">
              <p class="card-text">
                Spune-mi sincer. Sunt curioasa. Pe mine ma face fericita iubirea oamenilor.
              </p>
              <div class="form-check">
                <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                <label class="form-check-label" for="flexCheckDefault">
                  Familia mea
                </label>
              </div>
              <div class="form-check">
                <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                <label class="form-check-label" for="flexCheckDefault">
                  Pasiunile mele
                </label>
              </div>
              <div class="form-check">
                <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                <label class="form-check-label" for="flexCheckDefault">
                  Banii
                </label>
              </div>
              <div class="mb-3">
                <input id="exampleInputEmail1" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Altceva">
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
Vue.use(axios)

window.axios = require('axios')

export default {
  name: 'StartQuestionnairePage',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      displayQuestionnaire: null
    }
  },
  computed: {},
  mounted () {
    this.getQuestionnaire()
  },
  methods: {
    getQuestionnaire: function () {
      const url = window.location.origin
      const apiEndPoint = '/api/schedule-appointment/questionnaire'
      const fullApiUrl = url + apiEndPoint
      axios
        .get(fullApiUrl)
        .then(response => {
          console.log('>>>>> Display Questionnaire <<<<<<', response)
          this.displayQuestionnaire = response.data.results
        })
    }
  },
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
