<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div v-if="pageUnderConstruction === true"
           class="container lv-con-sect-questionnaire"
      >
        <under-construction-page />
      </div>
    </div>
  </div>
</template>

<script>
import UnderConstructionPage from '~/pages/errors/underConstruction.vue'

export default {
  name: 'StartQuestionnairePage',
  components: {
    UnderConstructionPage
  },
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      pageUnderConstruction: true
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {
    console.log('>>>>>> THIS: ', this)
  },
  methods: {},
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
