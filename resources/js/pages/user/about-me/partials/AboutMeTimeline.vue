<template>
  <div class="lv-con-about-me-timeline">
    <h1>{{ $t('user.about_me_page.timeline_section_title') }}</h1>
    <!-- HORIZONTAL TIMELINE, SECTION START -->
    <div class="bar" />
    <div class="timeline">
      <!-- HORIZONTAL TIMELINE PICTURES, SECTION START -->
      <div class="timeline-picture">
        <div v-for="image in timelineEventImages" :key="image.id" class="timeline-picture-event">
          <div class="card">
            <img :src="'images/about-me/Img-Timeline' + (image.id - 1) + '.jpg'"
                 class="card-img-top"
                 :alt="image.eventImageAlternativeTitle"
                 data-bs-toggle="modal"
                 :data-bs-target="'#enlargeImageModal' + image.id"
            >
            <p class="card-text">
              {{ image.eventImageText }}
              <span data-bs-toggle="modal"
                    :data-bs-target="'#readMoreImageModal' + image.id"
              >
                ({{ $t('user.about_me_page.timeline_section_read_more') }})
              </span>
            </p>
          </div>

          <!-- ENLARGE TIMELINE PICTURE, SECTION START -->
          <div :id="'enlargeImageModal' + image.id"
               class="modal fade"
               tabindex="-1"
               aria-labelledby="enlargeImageModalLabel"
               aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body modal-body--image">
                  <fa type="button"
                      icon="window-close"
                      fixed-width
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      :title="$t('user.about_me_page.timeline_modal_close')"
                  />
                  <img :src="'images/about-me/Img-Timeline' + (image.id - 1) + '.jpg'" :alt="image.eventImageAlternativeTitle">
                </div>
              </div>
            </div>
          </div>
          <!-- ENLARGE TIMELINE PICTURE, SECTION END -->

          <!-- IMAGE DETAILS, SECTION START -->
          <div :id="'readMoreImageModal' + image.id"
               class="modal fade"
               tabindex="-1"
               aria-labelledby="readMoreImageModalLabel"
               aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="readMoreImageModalLabel" class="modal-title">
                    Modal title
                  </h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <div class="modal-body">
                  <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid distinctio beatae incidunt quas, tempora voluptatem natus vero harum. Facere architecto ipsa, necessitatibus voluptatum qui tempora nostrum unde dolor dolores reiciendis minus hic atque nam. Tempore neque, nemo odit totam excepturi aliquam, aperiam eos non autem libero id nihil aut tempora laborum. Similique quos optio non suscipit alias! Laborum autem accusamus consectetur, explicabo nam ipsa, expedita officiis dolor sequi debitis voluptate corrupti? Sit exercitationem officia non, ipsa quaerat repellendus! Ipsa magni illo vel expedita quisquam cum, dicta quae doloribus libero sed odio maiores corrupti explicabo? Commodi deleniti iste voluptatum voluptate facilis? Iure magnam a alias dolorum, id consequuntur quo porro vitae velit deleniti. Magni, eveniet in molestias, numquam quae rem quam fugiat fuga modi maxime tempore. Tempore cum vero minus esse asperiores fuga exercitationem adipisci porro reprehenderit, pariatur eius non vel quas maiores temporibus repellat rerum illum quibusdam voluptatibus saepe eos enim itaque voluptatum ad. Officiis, suscipit harum ea tempora voluptatum repellat quibusdam repudiandae reiciendis at, cumque consequatur accusantium minus expedita obcaecati velit et! Molestiae nostrum earum quasi deserunt at, natus delectus eum facilis quam ipsum reiciendis odit laborum iusto maxime, aliquam a minus! Magnam architecto libero maiores ea eius. Vitae, eos. Culpa delectus praesentium aut necessitatibus. Error, voluptatum nesciunt nam eius facere, ex sapiente, culpa natus deserunt corrupti distinctio ullam molestiae ratione hic quos maxime tenetur ea! Mollitia alias aperiam dolorum velit dicta impedit vero libero quam facilis voluptatibus dolorem, deleniti maxime quis delectus amet accusantium. Impedit eaque illum accusamus.
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ $t('user.about_me_page.timeline_modal_close') }}
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- IMAGE DETAILS, SECTION END -->
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
  data: function () {
    return {
      timelineEventImages: [
        {
          id: 1,
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 2,
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 3,
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 4,
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 5,
          eventImageAlternativeTitle: '',
          eventImageText: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
        },
        {
          id: 6,
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
  }
}
</script>
