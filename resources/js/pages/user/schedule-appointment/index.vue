<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-appointment">
        <div class="lv-pg-appointment-header">
          <h1>Primii pași în călătoria ta</h1>
          <p>
            Pentru a începe călătoria e nevoie să ne pregătim bagajul. În acest caz este vorba despre bagajul emoțional.
            Și pentru a face itinerariul potrivit, mi-ar plăcea să știu în ce stare ești, cum te simți, ce îți dorești și unde vrei să ajungi. Iar pentru asta am pregătit chestionarul de mai jos.
            Sunt câteva întrebări pentru a descoperi nevoile tale, provocările cu care te confrunți și cum aș putea să te ajut să le înfrunți.
          </p>
          <p>
            Te voi ghida prin muzică, dans și voie bună.
            Am doar o rugăminte la tine: răspunde cât mai sincer la întrebări și scrie sau bifează primul răspuns care îți vine în minte.
            Mulțumesc pentru timpul acordat și spor la completat.
            De abia aștept să te cunosc.
            Te îmbrățișez cu drag.
          </p>
        </div>
        <div v-for="questionnaire in displayAllQuestionnaires" :key="questionnaire.id" class="lv-pg-appointment-body">
          <h1>
            {{ questionnaire.title }}
          </h1>
          <p>
            Bine te regăsesc. Mădălina sunt și îmi doresc să-ți aflu povestea emoțională.
          </p>
          <p>
            Am creat acest chestionar pentru a te cunoaște mai bine.
          </p>
          <p>
            Sunt câteva întrebări și completarea lui durează maxim 5 minute.
          </p>
          <p>
            Iar în cel mult 48 de ore vei primi pe email rezultatul.
          </p>
          <p>
            Mulțumesc anticipat pentru timpul acordat.
          </p>
          <div class="lv-pg-appointment-button">
            <a href="https://www.survio.com/survey/d/K6A2D2B2T5B8Y9X9S" class="btn btn-primary btn-lg" target="_blank" rel="noreferrer">Începeți chestionarul acum!</a>
            <!-- <button type="button" class="btn btn-primary btn-lg" @click="goToQuestionnaire(questionnaire.id)">
              Începeți chestionarul acum!
            </button> -->
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
  name: 'ScheduleAppointment',
  computed: {
    ...mapGetters({
      allQuestionnaires: 'questionnaire/allQuestionnaires'
    }),
    displayAllQuestionnaires () {
      return this.allQuestionnaires.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.allQuestionnaires.http_response_code
    }
  },
  created () {
    this.fetchQuestionnaires()
  },
  methods: {
    ...mapActions({
      fetchQuestionnaires: 'questionnaire/fetchQuestionnaires'
    }),
    goToQuestionnaire (id) {
      this.$router.push({ path: '/schedule-appointment/questionnaire/' + id })
    }
  },
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.page_title') }
  }
}
</script>
