<template>
  <div class="container lv-con-heading">
    <div class="lv-con-heading-lead">
      <h1 class="display-4">
        Fluid jumbotron
      </h1>
      <p class="lead">
        Lorem ipsum dolor sit amet contur adipisicing elit. Nobis dolorum blanditiis repellat porro est aliquid,
        esse magnam labore eaque maxime quae reiciendis vitae, harum fugiat adipisci ipsa placeat nostrum culpa quidem
        nulla doloribus nesciunt ipsam deleniti. Voluptates dicta praesentium quaerat?
      </p>
    </div>
    <div class="lv-con-heading-buttons">
      <div class="lv-con-heading-buttons-appointment">
        <button type="button"
                class="btn btn-primary btn-lg"
                @click="goTo"
        >
          <i class="far fa-clock" />
          {{ $t('user.home_page.heading.schedule_appointment_btn') }}
        </button>
      </div>
      <div class="lv-con-heading-buttons-social-media">
        <a v-for="share_button in jumbotron_buttons"
           :key="share_button.id"
           :href="share_button.url"
           :class="share_button.class"
           :target="share_button.target"
           :title="share_button.title"
           rel="noreferrer"
        >
          <fa :icon="[share_button.icon.prefix, share_button.icon.class]" fixed-width />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePageHeading',
  components: {},
  data: function () {
    return {
      jumbotron_buttons: [
        {
          id: 1,
          url: 'https://www.facebook.com/groups/269560668238590/?ref=share',
          class: 'btn btn-primary btn-lg',
          target: '_blank',
          title: this.$t('user.home_page.heading.social_media_btn.facebook_title'),
          icon: {
            prefix: 'fab',
            class: 'facebook'
          }
        },
        {
          id: 2,
          url: '',
          class: 'btn btn-primary btn-lg',
          target: '_blank',
          title: this.$t('user.home_page.heading.social_media_btn.instagram_title'),
          icon: {
            prefix: 'fab',
            class: 'instagram'
          }
        },
        {
          id: 3,
          url: '',
          class: 'btn btn-primary btn-lg',
          target: '_blank',
          title: this.$t('user.home_page.heading.social_media_btn.youtube_title'),
          icon: {
            prefix: 'fab',
            class: 'youtube'
          }
        }
      ]
    }
  },
  computed: {},
  methods: {
    goTo () {
      this.$router.push({ path: '/schedule-appointment' })
    }
  }
}
</script>
