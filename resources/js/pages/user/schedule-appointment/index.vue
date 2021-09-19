<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-appointment">
        <div class="display-tooltip display-tooltip--appointment-title display-tooltip--hide">
          1
          <span class="display-tooltip-text">
            <h1>Title:</h1>
            <p>
              <ul>
                <li>
                  In cazul in care e nevoie putem schimba titlul acestei pagini.
                </li>
              </ul>
            </p>
          </span>
        </div>
        <div class="display-tooltip display-tooltip--appointment-subtitle display-tooltip--hide">
          2
          <span class="display-tooltip-text">
            <h1>Subtitle:</h1>
            <p>
              <ul>
                <li>
                  De gasit un text de multumire ca o anumita persona a decis sa aleaga serviciile tale (aproximativ 20-30 cuvinte).
                </li>
              </ul>
            </p>
          </span>
        </div>
        <div class="display-tooltip display-tooltip--appointment-body display-tooltip--hide">
          3
          <span class="display-tooltip-text">
            <h1>Body:</h1>
            <p>
              <ul>
                <li>
                  De gasit un text din care sa reiasa scopul pentru care vrei sa faci acest chestionar (maxim 200 de cuvinte).
                </li>
              </ul>
              Referitor la punctul 3, textul pentru care l-am notat initial este: Pentru a stii cat de mult sa te ajut este nevoie sa completezi
              un chestionar cu privire la provocarile tale, pasiunile tale si muzica pe care o asculti.
            </p>
          </span>
        </div>
        <div class="lv-con-pg-appointment-title">
          <h1>Pregătire pentru Întâlnire</h1>
        </div>
        <div class="lv-con-pg-appointment-body">
          <p class="lead">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Nobis animi nihil, nostrum voluptatibus fugit numquam perspiciatis est excepturi omnis molestiae!
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Velit earum iure impedit voluptate, odio reiciendis asperiores neque,
            culpa accusamus magni nam libero aliquam! Temporibus corporis recusandae aliquid ipsam voluptates,
            cum eius ea voluptatibus laudantium sequi nihil sunt autem animi obcaecati fuga
            aut repudiandae cumque culpa praesentium! Sit recusandae in eveniet dolorem
            corporis quidem adipisci earum, possimus dolores alias quod doloribus obcaecati, autem,
            et nulla nam consectetur asperiores harum mollitia error nesciunt officiis quas.
            Quaerat quas magnam esse praesentium iste? Saepe sunt vero officiis labore distinctio assumenda voluptate,
            explicabo adipisci rerum in nostrum voluptatibus recusandae magnam inventore veritatis nemo obcaecati perspiciatis,
            tenetur exercitationem quis, ipsam officia. Beatae quod vitae similique repudiandae,
            ut quas molestias quis aperiam consequatur officiis perspiciatis est et.
          </p>
          <div class="lv-con-pg-appointment-button">
            <button type="button"
                    class="btn btn-primary btn-lg"
                    @click="goTo"
            >
              <i class="far fa-clock" />
              Începe chestionar!
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ScheduleAppointmentPage',
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
  methods: {
    goTo () {
      this.$router.push({ path: '/schedule-appointment/start-questionnaire' })
    }
  },
  metaInfo () {
    return { title: this.$t('user.schedule_appointment_page.page_title') }
  }
}
</script>
