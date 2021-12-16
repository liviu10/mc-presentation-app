<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div v-for="questionnaire in displaySingleQuestionnaire" :key="questionnaire.id" class="container lv-con-pg-questionnaire">
        <div class="lv-con-pg-questionnaire-title">
          <h1>
            {{ questionnaire.title }}
          </h1>
          <p class="lead">
            {{ questionnaire.scope }}
          </p>
        </div>
        <div class="lv-con-pg-questionnaire-body">
          <!-- QUESTIONNAIRE QUESTION 1, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[0].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[0].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[0].answer_suggestion }}
              </p>
              <div class="card-text">
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
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Altceva">
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 1, START END -->
          <!-- QUESTIONNAIRE QUESTION 2, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[1].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[2].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[3].answer_suggestion }}
              </p>
              <div class="card-text">
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Ceva care să îmi ofere și mai multă energie
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Ceva liniștitor
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Melodii pe care pot dansa
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Nu ascult muzică
                  </label>
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 2, START END -->
          <!-- QUESTIONNAIRE QUESTION 3, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[2].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[2].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[2].answer_suggestion }}
              </p>
              <div class="card-text">
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Ceva care să mă binedispună
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Ceva care să îmi dea energie
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Ceva care să mă liniștească
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Nu ascult muzică
                  </label>
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 3, START END -->
          <!-- QUESTIONNAIRE QUESTION 4, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[3].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[3].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[3].answer_suggestion }}
              </p>
              <div class="card-text">
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Rock soft sau hard rock
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Country/Pop
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Hip hop/ Dance
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Clasică/ Blues/ Jazz/ Folk
                  </label>
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Altele / Nu ascult muzică (te rog să scrii)">
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 4, START END -->
          <!-- QUESTIONNAIRE QUESTION 5, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[4].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[4].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[4].answer_suggestion }}
              </p>
              <div class="card-text">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Introduceți unul sau câteva cuvinte...">
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 5, START END -->
          <!-- QUESTIONNAIRE QUESTION 6, START SECTION -->
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[5].name }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[5].media_card_url }}
              </p>
              <p class="card-text">
                {{ questionnaire.questionnaire_questions[5].answer_suggestion }}
              </p>
              <div class="card-text">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Introduceți unul sau câteva cuvinte...">
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 6, START END -->
          <div class="form-button">
            <button type="submit" class="btn btn-primary">
              TRIMITE
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
  name: 'StartQuestionnairePage',
  computed: {
    ...mapGetters({
      singleQuestionnaire: 'questionnaire/singleQuestionnaire'
    }),
    displaySingleQuestionnaire () {
      return this.singleQuestionnaire.records
    },
    getHttpStatusResponseCode () {
      // TODO: How to catch api endpoint errors and display them to the user
      return this.singleQuestionnaire.http_response_code
    }
  },
  created () {
    this.fetchSingleQuestionnaire()
  },
  methods: {
    ...mapActions({
      fetchSingleQuestionnaire: 'questionnaire/fetchSingleQuestionnaire'
    })
  },
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
