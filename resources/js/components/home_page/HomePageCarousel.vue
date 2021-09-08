<template>
  <div id="carouselExampleCaptions" class="carousel slide lv-container-banner" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button v-for="carousel_indicator in carousel_indicators"
              :key="carousel_indicator.id"
              :type="carousel_indicator.type"
              :data-bs-target="carousel_indicator.data_bs_target"
              :data-bs-slide-to="carousel_indicator.data_bs_slide_to"
              :class="carousel_indicator.class"
              :aria-current="carousel_indicator.aria_current"
              :aria-label="carousel_indicator.aria_label"
      />
    </div>
    <div class="carousel-inner">
      <div v-for="carousel_image in carousel_images"
           :key="carousel_image.id"
           :class="'carousel-item ' + carousel_image.class"
      >
        <img :src="carousel_image.img_src" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>{{ carousel_image.caption_title }}</h5>
          <p>{{ carousel_image.caption_text }}</p>
          <button type="button" class="btn btn-primary">
            Află mai multe!
          </button>
        </div>
      </div>
    </div>
    <button v-for="carousel_control in carousel_controls"
            :key="carousel_control.id"
            :class="'carousel-control-' + carousel_control.class"
            :type="carousel_control.type"
            :data-bs-target="carousel_control.data_bs_target"
            :data-bs-slide="carousel_control.data_bs_slide"
    >
      <span :class="'carousel-control-' + carousel_control.class + '-icon'" aria-hidden="true" />
      <span class="visually-hidden">{{ carousel_control.name }}</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'HomePageCarousel',
  components: {},
  data: function () {
    return {
      carousel_indicators: [
        {
          id: 1,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 0,
          class: 'active',
          aria_current: 'true',
          aria_label: 'Slide 1'
        },
        {
          id: 2,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 1,
          class: '',
          aria_current: '',
          aria_label: 'Slide 2'
        },
        {
          id: 3,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 2,
          class: '',
          aria_current: '',
          aria_label: 'Slide 3'
        },
        {
          id: 4,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 3,
          class: '',
          aria_current: '',
          aria_label: 'Slide 4'
        },
        {
          id: 5,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 4,
          class: '',
          aria_current: '',
          aria_label: 'Slide 5'
        }
      ],
      carousel_images: [
        {
          id: 1,
          class: 'active',
          img_src: '/images/carousel/Carousel-img0.jpg',
          caption_title: 'First slide label',
          caption_text: 'Some representative placeholder content for the first slide.'
        },
        {
          id: 2,
          class: '',
          img_src: '/images/carousel/Carousel-img1.jpg',
          caption_title: 'Second slide label',
          caption_text: 'Some representative placeholder content for the second slide.'
        },
        {
          id: 3,
          class: '',
          img_src: '/images/carousel/Carousel-img2.jpg',
          caption_title: 'Third slide label',
          caption_text: 'Some representative placeholder content for the third slide.'
        },
        {
          id: 4,
          class: '',
          img_src: '/images/carousel/Carousel-img3.jpg',
          caption_title: 'Forth slide label',
          caption_text: 'Some representative placeholder content for the forth slide.'
        },
        {
          id: 5,
          class: '',
          img_src: '/images/carousel/Carousel-img4.jpg',
          caption_title: 'Fifth slide label',
          caption_text: 'Some representative placeholder content for the fifth slide.'
        }
      ],
      carousel_controls: [
        {
          id: 1,
          class: 'prev',
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide: 'prev',
          name: 'Previous'
        },
        {
          id: 2,
          class: 'next',
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide: 'next',
          name: 'Next'
        }
      ]
    }
  },
  computed: {}
}
</script>
