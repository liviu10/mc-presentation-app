<template>
  <div class="container lv-con-heading">
    <div class="lv-con-heading-lead">
      <p class="lead">
        Bine ai venit în călătoria ta experiențială!
        Urcă-te la bord și lasă-te purtat de tot ce vei experimenta.
        Aici vei regăsi diversitate de momente ca o shaorma cu de toate.
        În funcție de personalitatea ta vei afla cum muzica te poate influența și vei străluci în lumina inimii.
        Vor fi videouri săptămânale motivaționale, cu dans experiențial, cu recomandări nutriționale și cu multe altele.
        De asemenea poți citi povești de viață care să-ți dea de gândit și poți auzi unele lucruri haioase.
        Te-ai pregătit? Îndată am și pornit.
        Explorează-ți toate simțurile și pornește în călătoria ta!
      </p>
    </div>
    <div class="lv-con-heading-buttons">
      <div class="lv-con-heading-buttons-appointment">
        <router-link class="btn btn-primary btn-lg" to="/schedule-appointment">
          {{ $t('user.home_page.heading.schedule_appointment_btn') }}
        </router-link>
      </div>
      <div class="lv-con-heading-buttons-social-media">
        <a v-for="share_button in jumbotron_buttons"
           :key="share_button.id"
           :href="share_button.url"
           class="btn btn-primary btn-lg"
           target="_blank"
           :title="share_button.title"
           rel="noreferrer"
        >
          <fa :icon="['fab', share_button.icon_class]" fixed-width />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePageHeading',
  data: function () {
    return {
      jumbotron_buttons: [
        {
          id: 1,
          url: 'https://www.facebook.com/groups/269560668238590/?ref=share',
          title: this.$t('user.home_page.heading.social_media_btn.facebook_title'),
          icon_class: 'facebook'
        }
        // {
        //   id: 2,
        //   url: '',
        //   title: this.$t('user.home_page.heading.social_media_btn.instagram_title'),
        //   icon_class: 'instagram'
        // },
        // {
        //   id: 3,
        //   url: '',
        //   title: this.$t('user.home_page.heading.social_media_btn.youtube_title'),
        //   icon_class: 'youtube'
        // }
      ]
    }
  }
}
</script>
