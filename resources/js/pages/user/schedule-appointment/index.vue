<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-appointment">
        <div class="lv-pg-appointment-header">
          <h1>Pregătire pentru Întâlnire</h1>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Excepturi ipsam qui in architecto, dolorem quisquam exercitationem unde ab
            illum consectetur consequuntur temporibus maiores error esse neque incidunt deleniti
            est debitis necessitatibus non! Totam, quas nihil quia adipisci,
            voluptas perferendis culpa error incidunt laudantium sed inventore mollitia.
            Voluptate nesciunt quod officia reiciendis! Accusantium repudiandae illum ipsa nesciunt
            dicta laudantium at esse sed. Non praesentium nostrum unde,
            ab fugit necessitatibus facere cumque officiis. Illum dolorem ut quam,
            id amet eveniet incidunt hic adipisci, totam fugit suscipit ipsam repudiandae
            minus sed rem cumque minima recusandae quod labore saepe reiciendis deleniti doloribus omnis.
            Unde quidem error vitae. Iusto, libero? Blanditiis qui quaerat natus accusamus amet officiis iure quam quasi
            voluptates rerum cumque eum possimus, dolores aut quis sunt quisquam quos.
            Architecto tenetur nisi aliquid excepturi voluptatibus harum repellat numquam quibusdam doloremque nihil fuga maxime deleniti distinctio,
            ipsa iste officiis deserunt quod autem? Sunt quam non modi animi delectus et culpa cumque fuga, asperiores at?
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
            <button type="button" class="btn btn-primary btn-lg" @click="goToQuestionnaire(questionnaire.id)">
              Începeți chestionarul acum!
            </button>
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
