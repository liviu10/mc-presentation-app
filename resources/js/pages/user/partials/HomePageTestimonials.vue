<template>
  <div id="testimonialCarousel" class="carousel slide lv-con-testimonials" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button v-for="carousel_indicator in carousel_indicators"
              :key="carousel_indicator.id"
              type="button"
              data-bs-target="#testimonialCarousel"
              :data-bs-slide-to="carousel_indicator.id - 1"
              :class="carousel_indicator.class"
              :aria-current="carousel_indicator.aria_current"
              :aria-label="'Slide ' + carousel_indicator.id"
      />
    </div>
    <div class="carousel-inner">
      <div v-for="carousel_caption in carousel_captions"
           :key="carousel_caption.id"
           :class="'carousel-item ' + carousel_caption.class"
      >
        <h3>{{ carousel_caption.caption_title }}</h3>
        <p>{{ carousel_caption.caption_subtitle }}</p>
        <p>{{ carousel_caption.caption_text }}</p>
      </div>
    </div>
    <button v-for="carousel_control in carousel_controls"
            :key="carousel_control.id"
            :class="'carousel-control-' + carousel_control.class"
            type="button"
            data-bs-target="#testimonialCarousel"
            :data-bs-slide="carousel_control.class"
    >
      <span :class="'carousel-control-' + carousel_control.class + '-icon'" aria-hidden="true" />
      <span class="visually-hidden">{{ carousel_control.name }}</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'HomePageTestimonials',
  data: function () {
    return {
      carousel_indicators: [
        {
          id: 1,
          class: 'active',
          aria_current: 'true'
        },
        {
          id: 2,
          class: '',
          aria_current: ''
        },
        {
          id: 3,
          class: '',
          aria_current: ''
        }
      ],
      carousel_captions: [
        {
          id: 1,
          class: 'active',
          caption_title: 'Nume: Voica Liviu',
          caption_subtitle: 'Ocupatie: Developer',
          caption_text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.'
        },
        {
          id: 2,
          class: '',
          caption_title: 'Nume: Popescu George',
          caption_subtitle: 'Ocupatie: Developer',
          caption_text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.'
        },
        {
          id: 3,
          class: '',
          caption_title: 'Nume: Andreea Ionescu',
          caption_subtitle: 'Ocupatie: Developer',
          caption_text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.'
        }
      ],
      carousel_controls: [
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
  }
}
</script>
