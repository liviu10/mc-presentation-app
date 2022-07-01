<template>
  <div v-if="displayAllUserTestimonialSection && displayAllUserTestimonialSection.length" id="testimonialCarousel" class="carousel slide lv-con-testimonials" data-bs-ride="carousel">
    <div v-if="displayAllUserTestimonialSection.length !== 1" class="carousel-indicators">
      <button v-for="indicator_item in displayAllUserTestimonialSection"
              :key="indicator_item.id"
              type="button"
              data-bs-target="#testimonialCarousel"
              :data-bs-slide-to="indicator_item.id - 1"
              :class="indicator_item.id === 1 ? 'active' : ''"
              :aria-current="indicator_item.id === 1 ? 'true' : ''"
              :aria-label="'Slide ' + indicator_item.id"
      />
    </div>
    <div class="carousel-inner">
      <div v-for="inner_item in displayAllUserTestimonialSection"
           :key="inner_item.id"
           :class="inner_item.id === 1 ? 'carousel-item active' : 'carousel-item'"
      >
        <h3>{{ inner_item.name }}, {{ inner_item.occupation }}</h3>
        <p>{{ inner_item.description }}</p>
      </div>
    </div>
    <div v-if="displayAllUserTestimonialSection.length && displayAllUserTestimonialSection.length !== 1">
      <button v-for="control_item in carouselControls"
              :key="control_item.id"
              :class="'carousel-control-' + control_item.class"
              type="button"
              data-bs-target="#testimonialCarousel"
              :data-bs-slide="control_item.class"
      >
        <span :class="'carousel-control-' + control_item.class + '-icon'" aria-hidden="true" />
        <span class="visually-hidden">{{ control_item.name }}</span>
      </button>
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
  name: 'HomePageTestimonials',
  data: function () {
    return {
      carouselControls: [
        {
          id: 1,
          class: 'prev',
          name: 'Previous'
        },
        {
          id: 2,
          class: 'next',
          name: 'Next'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      allUserTestimonialSection: 'user_home_page/allUserTestimonialSection'
    }),
    displayAllUserTestimonialSection () {
      return this.allUserTestimonialSection.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.allUserTestimonialSection.http_response_code
    }
  },
  created () {
    this.fetchUserTestimonialSection()
  },
  methods: {
    ...mapActions({
      fetchUserTestimonialSection: 'user_home_page/fetchUserTestimonialSection'
    })
  }
}
</script>
