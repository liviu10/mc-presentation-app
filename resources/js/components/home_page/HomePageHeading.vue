<template>
  <div class="container lv-con-sect-heading">
    <div class="lv-con-sect-heading-lead">
      <h1 class="display-4">
        Fluid jumbotron
      </h1>
      <p class="lead">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis dolorum blanditiis repellat porro est aliquid,
        esse magnam labore eaque maxime quae reiciendis vitae, harum fugiat adipisci ipsa placeat nostrum culpa quidem
        nulla doloribus nesciunt ipsam deleniti. Voluptates dicta praesentium quaerat?
      </p>
    </div>
    <div class="lv-con-sect-heading-buttons">
      <div class="lv-con-sect-heading-buttons-appointment">
        <button type="button"
                class="btn btn-primary btn-lg"
                @click="goTo"
        >
          <i class="far fa-clock" />
          Programează-te!
        </button>
      </div>
      <div class="lv-con-sect-heading-buttons-social-media">
        <a v-for="share_button in jumbotron_buttons"
           :key="share_button.id"
           :href="share_button.url"
           :class="share_button.class"
           :target="share_button.target"
           :title="share_button.title"
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
          title: 'Urmărește-mă pe Facebook!',
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
          title: 'Urmărește-mă pe Instagram!',
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
          title: 'Urmărește-mă pe Youtube!',
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
