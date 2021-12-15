<template>
  <div id="carouselExampleCaptions" class="carousel slide lv-con-banner" data-bs-ride="carousel">
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
          <p>{{ carousel_image.caption_title }}</p>
          <p>{{ carousel_image.caption_text_1 }}</p>
          <p>{{ carousel_image.caption_text_2 }}</p>
          <p>{{ carousel_image.caption_text_3 }}</p>
          <p>{{ carousel_image.caption_text_4 }}</p>
          <button type="button" class="btn btn-primary">
            {{ $t('user.home_page.carousel.find_out_more_btn') }}
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
        },
        {
          id: 6,
          type: 'button',
          data_bs_target: '#carouselExampleCaptions',
          data_bs_slide_to: 5,
          class: '',
          aria_current: '',
          aria_label: 'Slide 6'
        }
      ],
      carousel_images: [
        {
          id: 1,
          class: 'active',
          img_src: '/images/carousel/Carousel-img0_1920.webp',
          caption_title: 'Iubire de oameni',
          caption_text_1: 'Întotdeauna mi-a plăcut să fiu înconjurată de oameni și am ascultat cu încântare poveștile lor de viață.',
          caption_text_2: 'Am realizat că cel mai important dar pe care îl poți oferi lumii este timpul tău și energia ta.',
          caption_text_3: 'Și din toată inima îmi doresc să pot ajuta cât mai mulți oameni cu ceea ce au nevoie.'
        },
        {
          id: 2,
          class: '',
          img_src: '/images/carousel/Carousel-img1_1920.webp',
          caption_title: 'Inspirație pentru creștere',
          caption_text_1: '”Cei pe care îi servești, îți arată cum să crești”- Andy Szekely',
          caption_text_2: 'Din anul 2016 m-am lăsat ghidată de Andy Szekely în dezvoltarea mea si am crescut armonios. Participarea la evenimentele lui si comunitatea lui de oameni faini m-au inspirat și am devenit omul energic de acum.',
          caption_text_3: 'Am fost fascinată de stilul lui Andy de a povesti și de a amuza oamenii și așa îmi doresc să transmit și eu informațiile.'
        },
        {
          id: 3,
          class: '',
          img_src: '/images/carousel/Carousel-img2_1920.webp',
          caption_title: 'Liniște interioară',
          caption_text_1: 'În secolul vitezei și în lumea agitată în care trăim, a rămâne calm și liniștit este un lucru măreț.',
          caption_text_2: 'Relaxarea prin meditație și dans te ajută să înfrunți provocările în viață. Vrei să încerci?'
        },
        {
          id: 4,
          class: '',
          img_src: '/images/carousel/Carousel-img3_1920.webp',
          caption_title: 'Împlinire prin dans',
          caption_text_1: 'Când ești pasionat de ceva încă de mic și vezi că nu îți trece cu nimic în timp, înseamnă că este ceea ce ți se potrivește.',
          caption_text_2: 'Dansez de când mă știu și îmi doresc să ghidez cât mai mulți oameni să-și găseasca propriul ritm în viață.',
          caption_text_3: 'Totul începe cu primul pas.'
        },
        {
          id: 5,
          class: '',
          img_src: '/images/carousel/Carousel-img4_1920.webp',
          caption_title: 'Sunt aici să te ascult',
          caption_text_1: 'Când suntem ascultați și ghidați de cineva, lucrurile devin mai ușor de făcut.',
          caption_text_2: 'Cum și eu am găsit inspirație și oameni care m-au ascultat și ajutat în dezvoltarea mea, așa și tu poți.',
          caption_text_3: 'Mă poți contacta când ai nevoie de ceva.'
        },
        {
          id: 6,
          class: '',
          img_src: '/images/carousel/Carousel-img4_1920.webp',
          caption_title: 'Alergător de fapte bune',
          caption_text_1: 'Am fost o persoană sedentară mulți ani și sportul nu-mi plăcea deloc. Dar când am descoperit că pot ajuta pe alții făcând mișcare, m-am apucat de alergat.',
          caption_text_2: 'Mișcarea în natură are multe beneficii atât fizice, cât și mentale și le-am simțit din plin la cursele de 10 km de până acum.',
          caption_text_3: 'Așa am reușit să fiu mai sănătoasă și să mă implic în activități caritabile.',
          caption_text_4: 'Run for a good life.'
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
  }
}
</script>
