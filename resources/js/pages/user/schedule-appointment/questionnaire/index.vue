<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div v-for="questionnaire in displaySingleQuestionnaire" :key="questionnaire.id" class="lv-con-pg-questionnaire">
        <div class="lv-con-pg-questionnaire-header">
          <h1>
            {{ questionnaire.title }}
          </h1>
          <p>
            {{ questionnaire.scope }}
          </p>
        </div>
        <div class="lv-con-pg-questionnaire-body">
          <!-- QUESTIONNAIRE QUESTION 1, START SECTION -->
          <div v-for="question in questionnaire.questionnaire_questions" :key="question.id" class="card">
            <div class="card-body">
              <p class="lv-con-pg-questionnaire-body-question-name">
                {{ question.id }}. {{ question.name }}
              </p>
              <p class="lv-con-pg-questionnaire-body-question-suggestion">
                {{ question.answer_suggestion }}
              </p>
              <p v-if="question.questionnaire_media_type_id === 1" class="lv-con-pg-questionnaire-body-question-image" />
              <p v-if="question.questionnaire_media_type_id === 2" class="lv-con-pg-questionnaire-body-question-image">
                <img :src="question.media_card_url" alt="" width="auto" height="auto">
              </p>
              <p v-if="question.questionnaire_media_type_id === 3" class="lv-con-pg-questionnaire-body-question-image">
                <iframe width="480" height="288"
                        :src="question.media_card_url"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                />
              </p>
              <div v-if="question.question_type_id === 1" class="card-text">
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox">
                  <label class="form-check-label" for="flexCheckDefault">
                    Familia mea
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox">
                  <label class="form-check-label" for="flexCheckDefault">
                    Pasiunile mele
                  </label>
                </div>
                <div class="form-check">
                  <input id="flexCheckDefault" class="form-check-input" type="checkbox">
                  <label class="form-check-label" for="flexCheckDefault">
                    Banii
                  </label>
                </div>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Altceva">
                </div>
              </div>
              <div v-if="question.question_type_id === 2" class="card-text">
                <div>
                  Measuring scale here
                </div>
              </div>
              <div v-if="question.question_type_id === 6" class="card-text">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Introduceți unul sau câteva cuvinte...">
                </div>
              </div>
            </div>
          </div>
          <!-- QUESTIONNAIRE QUESTION 1, START END -->
          <div class="lv-con-pg-questionnaire-body-button">
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
