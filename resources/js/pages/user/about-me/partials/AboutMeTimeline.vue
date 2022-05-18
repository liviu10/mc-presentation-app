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
            <img :src="'images/pages/about_me/Img-Timeline' + (image.id - 1) + '_600' + '.webp'"
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
               data-bs-backdrop="static"
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
                  <img :src="'images/pages/about_me/Img-Timeline' + (image.id - 1) + '_600' + '.webp'" :alt="image.eventImageAlternativeTitle">
                </div>
              </div>
            </div>
          </div>
          <!-- ENLARGE TIMELINE PICTURE, SECTION END -->

          <!-- IMAGE DETAILS, SECTION START -->
          <div :id="'readMoreImageModal' + image.id"
               class="modal fade"
               tabindex="-1"
               :aria-labelledby="'readMoreImageModalLabel' + image.id"
               aria-hidden="true"
               data-bs-backdrop="static"
          >
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 :id="'readMoreImageModalLabel' + image.id" class="modal-title">
                    {{ image.eventDate }} &#8212; {{ image.eventImageText }}
                  </h4>
                </div>
                <div class="modal-body">
                  <p>
                    {{ image.eventImageDetails }}
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
          eventImageAlternativeTitle: 'Clubul Elevilor din Turnu Măgurele',
          eventImageText: 'Cursuri de dans la Clubul Elevilor din Turnu Măgurele',
          eventDate: '1998 - 1999',
          eventImageDetails: 'În clasa a treia am fost înscrisă de mama mea la cursurile de dans liber de la Clubul Elevilor din orașul natal. Atunci am prins plăcerea dansului. Am participat și la 2 evenimente ca majoretă: primul a fost un meci de handbal în orașul Alexandria și cel de-al doilea a fost la Zilele orașului Turnu Măgurele pe melodia ”Rasputin” a lui Boney M.'
        },
        {
          id: 2,
          eventImageAlternativeTitle: 'Clubul de Ecologie și Turism ”EcoTur”',
          eventImageText: 'Voluntar în Clubul de Ecologie și Turism ”EcoTur” din cadrul Academiei de Studii Economice din București și în comunitatea HrEmotion',
          eventDate: '2009 - 2011',
          eventImageDetails: 'A fost cea mai frumoasă perioadă din viața mea fiindcă atunci am învățat ce înseamnă cu adevărat munca în echipă, cum să organizez teambuildinguri și am coordonat proiectul de reciclare ” EcoTur pentru hârtie”, în care s-au strâns 444 kg de maculatură pe care am reciclat-o și astfel am salvat 7 copaci. Iar în comunitatea HrEmotion am învățat despre Feedback, Time Management, Mentorat, Autonomie în învățare și Coaching.'
        },
        {
          id: 3,
          eventImageAlternativeTitle: 'Cursă de alergat în Pădurea Cernica, București',
          eventImageText: 'Prima cursă de alergat de 7 km în Pădurea Cernica, București',
          eventDate: '2016',
          eventImageDetails: 'Am ocupat locul 18 din 234 de participanți și mi-am depășit limitele fizice. Am trecut de la o persoană Sedentară la una Activă. Pasiunea pentru alergat am dus-o pe parcurs la alt nivel, fiindcă am participat la curse de 11 km și de 30 km în scop caritabil în ultimii ani.'
        },
        {
          id: 4,
          eventImageAlternativeTitle: 'Comunitatea lui Andy Szekely',
          eventImageText: 'Dezvoltare personală alături de comunitatea lui Andy Szekely',
          eventDate: '2017 - prezent',
          eventImageDetails: 'Primul eveniment susținut de Andy la care am participat a fost în 2017 și se numea de la ”Obiectiv la Rezultat.” Mi-a plăcut stilul lui foarte mult și m-am decis să particip la toate evenimentele lui și ale comunității AS. Am învățat multe lucruri despre mine și despre cum aș putea să cresc și să contribui în viețile oamenilor din jurul meu. De atunci este mentorul meu și consider că mi-a schimbat viața.'
        },
        {
          id: 5,
          eventImageAlternativeTitle: 'Școala ”Let’s Dance”',
          eventImageText: 'Cursuri de dans la Școala ”Let’s Dance” și diploma de Tehnician Nutriționist',
          eventDate: '2017 - 2018',
          eventImageDetails: 'Când m-am înscris la cursurile de dans în 2017, mi-am propus să fac cât mai multe stiluri de dans și am reușit să realizez care sunt genurile mele preferate și anume: Salsa, Bachata, Kizomba, Rock&Roll și Jive. A fost o experiență minunată unde m-am distrat și mi-am făcut prieteni. Tot în 2018 am urmat cursurile de 3 luni de Tehnician Nutriționist pentru a putea să ajut oamenii cu diete personalizate atunci când au nevoie de câteva sfaturi nutriționale.'
        },
        {
          id: 6,
          eventImageAlternativeTitle: 'Instructor de dans, de Speaker și de creator de concepte vocaționale',
          eventImageText: 'Cursuri de Instructor de dans, de Speaker și de creator de concepte vocaționale',
          eventDate: '2020 - 2021',
          eventImageDetails: 'În aprilie 2020 am urmat cursurile de instructor de dans de la Dance Sport Academy pentru a putea preda oamenilor pasionați de dans anumite mișcări care să-i ajute să se relaxeze. Un vis devenit realitate. În septembrie 2020 până în decembrie 2020 am urmat cursurile Speaker elite din comunitatea AS și am învățat tehnici de a susține un discurs în fața publicului, chiar și în online. Din februarie 2021 până în iunie 2021 am participat la programul MAGIC(Mentor, Autor, Ghid Inner Circle) al lui Andy Szekely și am creat conceptul de Dans Experiențial, prin care ajut oamenii să-și descopere ritmul corpului lor și să-și manifeste emoțiile prin dans.'
        }
      ],
      timelineEventEntries: [
        {
          id: 1,
          eventDate: '1998 - 1999'
        },
        {
          id: 2,
          eventDate: '2009 - 2011'
        },
        {
          id: 3,
          eventDate: '2016'
        },
        {
          id: 4,
          eventDate: '2017 - prezent'
        },
        {
          id: 5,
          eventDate: '2017 - 2018'
        },
        {
          id: 6,
          eventDate: '2020 - 2021'
        }
      ]
    }
  }
}
</script>
