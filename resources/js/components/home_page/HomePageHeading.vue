<template>
  <div class="container lv-con-sect-heading">
    <div class="lv-con-sect-heading-lead">
      <div class="display-tooltip display-tooltip--banner display-tooltip--hide">
        3
        <span class="display-tooltip-text">
          <h1>Banner:</h1>
          <p>
            Carousel-ul este setat sa deruleze fiecare imagine de la dreapta spre stanga, cu o durata a tranzitiei de 1.5 secunde.
            <ul>
              <li>
                De gasit minim 3 imagini pentru acest banner care sa aiba minim dimensiunea de 1920px (width) / 1080px (height) si sa fie orientate in modul landscape
              </li>
              <li>
                De gasit un titlu pentru fiecare imagine a banner-ului (aproximativ 5-7 cuvinte).
              </li>
              <li>
                De gasit o descriere scurta pentru fiecare imagine a banner-ului (maxim 50 cuvinte).
              </li>
            </ul>
          </p>
        </span>
      </div>
      <div class="display-tooltip display-tooltip--jumbotron-title display-tooltip--hide">
        4
        <span class="display-tooltip-text">
          <h1>Title:</h1>
          <p>
            <ul>
              <li>
                Doar daca consideri ca ar fi bine sa adaugam un titlu la sectiunea asta, daca nu, afisam doar scurta descriere a site-ului.
              </li>
            </ul>
          </p>
        </span>
      </div>
      <div class="display-tooltip display-tooltip--jumbotron-body display-tooltip--hide">
        5
        <span class="display-tooltip-text">
          <h1>Body:</h1>
          <p>
            <ul>
              <li>
                De gasit o scurta descriere pentru aceasta sectiune (maxim 50 de cuvinte).
              </li>
            </ul>
          </p>
        </span>
      </div>
      <div class="display-tooltip display-tooltip--jumbotron-social-media display-tooltip--hide">
        6
        <span class="display-tooltip-text">
          <h1>Social media:</h1>
          <p>
            <ul>
              <li>
                De trimis link-ul catre grupul tau de facebook.
              </li>
              <li>
                De trimis link-ul catre profilul tau de instagram.
              </li>
              <li>
                De trimis link-ul catre canalul tau de youtube.
              </li>
            </ul>
          </p>
        </span>
      </div>
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
          {{ $t('user.home_page.heading.schedule_appointment_btn') }}
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
