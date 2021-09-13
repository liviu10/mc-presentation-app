<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-sect-questionnaire">
        <h1>APP START QUESTIONNAIRE PAGE</h1>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StartQuestionnairePage',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {}
  },
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {},
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.start_questionnaire.page_title') }
  }
}
</script>
