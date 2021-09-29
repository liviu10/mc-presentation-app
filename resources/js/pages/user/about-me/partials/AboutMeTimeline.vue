<template>
  <div class="lv-con-pg-about-timeline">
    <h1>{{ $t('user.about_me_page.timeline_section_title') }}</h1>
    <!-- HORIZONTAL TIMELINE, SECTION START -->
    <div class="bar" />
    <div class="timeline">
      <!-- HORIZONTAL TIMELINE PICTURES, SECTION START -->
      <div class="timeline-picture">
        <div v-for="image in timelineEventImages"
             :key="image.id"
             class="timeline-picture-event"
        >
          <div class="card">
            <img :src="image.eventImageSource"
                 class="card-img-top"
                 :alt="image.eventImageAlternativeTitle"
                 data-bs-toggle="modal"
                 :data-bs-target="'#exampleModal' + image.id"
            >
            <p class="card-text">
              {{ image.eventImageText }}
            </p>
          </div>
          <!-- ENLARGE TIMELINE PICTURE, SECTION START -->
          <div :id="'exampleModal' + image.id"
               class="modal fade"
               tabindex="-1"
               aria-labelledby="exampleModalLabel"
               aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <fa type="button"
                      icon="window-close"
                      fixed-width
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      title="Închide fereastra!"
                  />
                  <img :src="image.eventImageSource"
                       :alt="image.eventImageAlternativeTitle"
                  >
                  <button type="button" class="btn btn-primary">
                    Vezi mai multe
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- ENLARGE TIMELINE PICTURE, SECTION END -->
        </div>
      </div>
      <!-- HORIZONTAL TIMELINE PICTURES, SECTION END -->

      <!-- HORIZONTAL TIMELINE EVENTS, SECTION START -->
      <div class="timeline-event">
        <div v-for="entry in timelineEventEntries"
             :key="entry.id"
             class="timeline-event-entry"
        >
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                {{ entry.eventDate }}
              </h5>
            </div>
          </div>
        </div>
      </div>
      <!-- HORIZONTAL TIMELINE EVENTS, SECTION END -->
    </div>
    <!-- HORIZONTAL TIMELINE, SECTION END -->
  </div>
</template>

<script>
export default {
  name: 'AboutMeTimeline',
  components: {},
  layout: '',
  middleware: '',
  props: {},
  data: function () {
    return {
      timelineEventImages: [
        {
          id: 1,
          eventImageSource: 'images/about-me/Img-Timeline0.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 2,
          eventImageSource: 'images/about-me/Img-Timeline1.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 3,
          eventImageSource: 'images/about-me/Img-Timeline2.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 4,
          eventImageSource: 'images/about-me/Img-Timeline3.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 5,
          eventImageSource: 'images/about-me/Img-Timeline4.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 6,
          eventImageSource: 'images/about-me/Img-Timeline5.jpg',
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        }
      ],
      timelineEventEntries: [
        {
          id: 1,
          eventDate: '29.09.2012'
        },
        {
          id: 2,
          eventDate: '13.05.2015'
        },
        {
          id: 3,
          eventDate: '01.09.2015'
        },
        {
          id: 4,
          eventDate: '12.04.2016'
        },
        {
          id: 5,
          eventDate: '30.04.2017'
        },
        {
          id: 6,
          eventDate: '11.11.2019'
        }
      ]
    }
  },
  computed: {
    // mapped getters}
  },
  mounted () {},
  methods: {},
  metaInfo () {}
}
</script>
