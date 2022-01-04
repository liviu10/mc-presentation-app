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
        <form @submit.prevent="finishQuestionnaire" @keydown="form.onKeydown($event)">
          <div class="lv-con-pg-questionnaire-body">
            <!-- QUESTIONNAIRE QUESTIONS, START SECTION -->
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
                <div v-for="answer in question.questionnaire_answers" :key="answer.id">
                  <div v-if="question.question_type_id === 1" class="card-text">
                    <p class="lv-con-pg-questionnaire-body-question-tooltip">
                      (Pentru a alege altă variantă de răspuns debifează varianta aleasă inițial)
                    </p>
                    <div class="form-check">
                      <input :id="answer.id + '_answer_1'"
                             v-model="form.answer_1"
                             class="form-check-input"
                             type="checkbox"
                             name="answer_1"
                             :disabled="form.answer_2 || form.answer_3 || form.answer_4 || form.answer_5 ? true : false"
                      >
                      <label class="form-check-label" :for="answer.id + '_answer_1'">
                        {{ answer.answer_1 }}
                      </label>
                    </div>
                    <div class="form-check">
                      <input id="answer_2"
                             v-model="form.answer_2"
                             class="form-check-input"
                             type="checkbox"
                             name="answer_2"
                             :disabled="form.answer_1 || form.answer_3 || form.answer_4 || form.answer_5 ? true : false"
                      >
                      <label class="form-check-label" for="answer_2">
                        {{ answer.answer_2 }}
                      </label>
                    </div>
                    <div class="form-check">
                      <input id="answer_3"
                             v-model="form.answer_3"
                             class="form-check-input"
                             type="checkbox"
                             name="answer_3"
                             :disabled="form.answer_1 || form.answer_2 || form.answer_4 || form.answer_5 ? true : false"
                      >
                      <label class="form-check-label" for="answer_3">
                        {{ answer.answer_3 }}
                      </label>
                    </div>
                    <div class="form-check">
                      <input id="answer_4"
                             v-model="form.answer_4"
                             class="form-check-input"
                             type="checkbox"
                             name="answer_4"
                             :disabled="form.answer_1 || form.answer_2 || form.answer_3 || form.answer_5 ? true : false"
                      >
                      <label class="form-check-label" for="answer_4">
                        {{ answer.answer_4 }}
                      </label>
                    </div>
                    <div class="input-group">
                      <input id="answer_5"
                             v-model="form.answer_5"
                             class="form-control"
                             type="text"
                             :placeholder="answer.answer_5"
                             :disabled="form.answer_1 || form.answer_2 || form.answer_3 || form.answer_4 ? true : false"
                      >
                    </div>
                  </div>
                  <div v-if="question.question_type_id === 2" class="card-text">
                    <div>
                      {{ answer.answer_1 }}
                    </div>
                  </div>
                  <div v-if="question.question_type_id === 6" class="card-text">
                    <div class="input-group">
                      <input type="text" class="form-control" :placeholder="answer.answer_5 + '...'">
                    </div>
                  </div>
                </div>
              </div>
              <!-- QUESTIONNAIRE QUESTIONS, END SECTION -->
              <div class="lv-con-pg-questionnaire-body-button">
                <button type="submit" class="btn btn-primary" @click.stop.prevent="finishQuestionnaire(question.id)">
                  RĂSPUNDE
                </button>
                <!-- <button type="submit" class="btn btn-primary" @click.stop.prevent="finishQuestionnaire(question.id)">
                  RESETEAZĂ
                </button> -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Form from 'vform'
import Vuex, { mapGetters, mapActions } from 'vuex'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'StartQuestionnairePage',
  data: function () {
    return {
      form: new Form([
        {
          value: 'Varianta 1',
          answer_1: false
        }
        // answer_2: false,
        // answer_3: false,
        // answer_4: false,
        // answer_5: ''
      ])
    }
  },
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
    }),
    answerHasBeenResponded () {
      console.log('> Check form: ', this.form)
    },
    async finishQuestionnaire (id) {
      const payload = {
        questionnaire_answer_id: id,
        response_1: this.form.answer_1,
        response_2: this.form.answer_2,
        response_3: this.form.answer_3,
        response_4: this.form.answer_4,
        response_5: this.form.answer_5
      }
      try {
        await this.$store.dispatch('questionnaire/finishQuestionnaire', payload)
        // TODO: route push to another page and empty the form after leaving the page
        // TODO: the has-error html tag is not displaying any backend errors
        // TODO: how do I know that I am sending the answer(s) for question nr. 1?
      } catch (e) {
        console.log(e)
      }
    }
  },
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
