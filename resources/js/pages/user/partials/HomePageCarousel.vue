<template>
  <div id="homePageCarousel" class="carousel slide lv-con-banner" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button v-for="carousel_indicator in carousel_indicators"
              :key="carousel_indicator.id"
              type="button"
              data-bs-target="#homePageCarousel"
              :data-bs-slide-to="carousel_indicator.id - 1"
              :class="carousel_indicator.class"
              :aria-current="carousel_indicator.aria_current"
              :aria-label="'Slide ' + carousel_indicator.id"
      />
    </div>
    <div class="carousel-inner">
      <div v-for="carousel_image in carousel_images"
           :key="carousel_image.id"
           :class="'carousel-item ' + carousel_image.class"
      >
        <div class="carousel-img">
          <img :src="'/images/carousel/' + carousel_image.img_src" class="d-block" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <p>{{ carousel_image.caption_title }}</p>
          <div class="carousel-caption-body">
            <p v-for="caption in carousel_image.caption_text" :key="caption.id">
              {{ caption }}
            </p>
          </div>
          <button type="button" class="btn btn-primary">
            {{ $t('user.home_page.carousel.find_out_more_btn') }}
          </button>
        </div>
      </div>
    </div>
    <button v-for="carousel_control in carousel_controls"
            :key="carousel_control.id"
            :class="'carousel-control-' + carousel_control.class"
            type="button"
            data-bs-target="#homePageCarousel"
            :data-bs-slide="carousel_control.class"
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
        },
        {
          id: 4,
          class: '',
          aria_current: ''
        },
        {
          id: 5,
          class: '',
          aria_current: ''
        },
        {
          id: 6,
          class: '',
          aria_current: ''
        }
      ],
      carousel_images: [
        {
          id: 1,
          class: 'active',
          img_src: 'Carousel-img0_1920.webp',
          caption_title: 'Iubire de oameni',
          caption_text: {
            caption_text_1: 'Întotdeauna mi-a plăcut să fiu înconjurată de oameni și am ascultat cu încântare poveștile lor de viață.',
            caption_text_2: 'Am realizat că cel mai important dar pe care îl poți oferi lumii este timpul tău și energia ta.',
            caption_text_3: 'Și din toată inima îmi doresc să pot ajuta cât mai mulți oameni cu ceea ce au nevoie.'
          },
          caption_quote: false
        },
        {
          id: 2,
          class: '',
          img_src: 'Carousel-img1_1920.webp',
          caption_title: 'Inspirație pentru creștere',
          caption_text: {
            caption_text_1: '”Cei pe care îi servești, îți arată cum să crești”- Andy Szekely',
            caption_text_2: 'Din anul 2016 m-am lăsat ghidată de Andy Szekely în dezvoltarea mea si am crescut armonios. Participarea la evenimentele lui si comunitatea lui de oameni faini m-au inspirat și am devenit omul energic de acum.',
            caption_text_3: 'Am fost fascinată de stilul lui Andy de a povesti și de a amuza oamenii și așa îmi doresc să transmit și eu informațiile.'
          },
          caption_quote: true
        },
        {
          id: 3,
          class: '',
          img_src: 'Carousel-img2_1920.webp',
          caption_title: 'Liniște interioară',
          caption_text: {
            caption_text_1: 'În secolul vitezei și în lumea agitată în care trăim, a rămâne calm și liniștit este un lucru măreț.',
            caption_text_2: 'Relaxarea prin meditație și dans te ajută să înfrunți provocările în viață. Vrei să încerci?'
          },
          caption_quote: false
        },
        {
          id: 4,
          class: '',
          img_src: 'Carousel-img3_1920.webp',
          caption_title: 'Împlinire prin dans',
          caption_text: {
            caption_text_1: 'Când ești pasionat de ceva încă de mic și vezi că nu îți trece cu nimic în timp, înseamnă că este ceea ce ți se potrivește.',
            caption_text_2: 'Dansez de când mă știu și îmi doresc să ghidez cât mai mulți oameni să-și găseasca propriul ritm în viață.',
            caption_text_3: 'Totul începe cu primul pas.'
          },
          caption_quote: false
        },
        {
          id: 5,
          class: '',
          img_src: 'Carousel-img4_1920.webp',
          caption_title: 'Sunt aici să te ascult',
          caption_text: {
            caption_text_1: 'Când suntem ascultați și ghidați de cineva, lucrurile devin mai ușor de făcut.',
            caption_text_2: 'Cum și eu am găsit inspirație și oameni care m-au ascultat și ajutat în dezvoltarea mea, așa și tu poți.',
            caption_text_3: 'Mă poți contacta când ai nevoie de ceva.'
          },
          caption_quote: false
        },
        {
          id: 6,
          class: '',
          img_src: 'Carousel-img4_1920.webp',
          caption_title: 'Alergător de fapte bune',
          caption_text: {
            caption_text_1: 'Am fost o persoană sedentară mulți ani și sportul nu-mi plăcea deloc. Dar când am descoperit că pot ajuta pe alții făcând mișcare, m-am apucat de alergat.',
            caption_text_2: 'Mișcarea în natură are multe beneficii atât fizice, cât și mentale și le-am simțit din plin la cursele de 10 km de până acum.',
            caption_text_3: 'Așa am reușit să fiu mai sănătoasă și să mă implic în activități caritabile.',
            caption_text_4: 'Run for a good life.'
          },
          caption_quote: false
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
