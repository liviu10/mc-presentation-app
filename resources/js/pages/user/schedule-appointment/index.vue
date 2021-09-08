<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-con-pg-appointment">
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
  computed: {},
  methods: {
    goTo () {
      this.$router.push({ path: '/schedule-appointment/start-questionnaire' })
    }
  }
}
</script>
