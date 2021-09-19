<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-articles">
        <div class="lv-con-pg-articles-title">
          <h1>APP DISPLAY WRITTEN ARTICLE PAGE</h1>
        </div>
        <div class="lv-con-pg-articles-view">
          <!-- DISPLAY WRITTEN ARTICLE TITLE, SECTION START -->
          <div class="lv-con-pg-articles-view-title">
            <h4>Lorem, ipsum dolor.</h4>
            <p>
              <span>Mădălina Corina Marius</span> &bullet;
              <span>Septembrie 11 2021</span> &bullet;
              <span>15 minute citire</span>
            </p>
            <div class="title-divider" />
          </div>
          <!-- DISPLAY WRITTEN ARTICLE TITLE, SECTION END -->
          <!-- DISPLAY WRITTEN ARTICLE BODY, SECTION START -->
          <div class="lv-con-pg-articles-view-body">
            <div class="lv-con-pg-articles-view-body-heading">
              <img src="/images/blog/article-img-320x320.jpg" alt="">
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Ipsum neque consequuntur quia error dolores nemo natus temporibus est ea inventore,
                doloribus quaerat eligendi libero odit vero adipisci aliquid. Blanditiis veniam aperiam,
                assumenda illum eaque vero autem nostrum debitis voluptatum,
                dolor cum reiciendis delectus corporis ducimus laboriosam repellat totam maxime dolores animi in at?
                Deserunt, explicabo repellendus aperiam autem dicta a itaque eaque similique laudantium magni modi delectus eligendi tempora porro rem ut!
                Ut qui praesentium consequuntur, iusto quibusdam iste voluptatibus illum laudantium autem alias voluptates accusamus laboriosam deleniti consectetur.
                Ipsa laborum eos illo quia atque dicta aspernatur est iure iste. Iure, velit cum. Consectetur voluptate reiciendis cupiditate eligendi officiis dolorem debitis deserunt!
                Architecto iure quas eaque itaque porro temporibus delectus.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Consequuntur officiis, possimus mollitia ab, temporibus alias dolor similique impedit inventore vel dicta est rem,
                sequi assumenda nulla fuga atque ipsum facere non deleniti fugit sint.
              </p>
            </div>
            <p>
              Iure dolorum quis nulla enim nemo,
              odit repudiandae assumenda aliquam inventore, voluptatem iste! Similique vitae earum quisquam, porro nam minus deleniti, placeat,
              aliquid obcaecati ratione magni cupiditate voluptate natus voluptatibus ipsam inventore adipisci quod totam laudantium quasi repudiandae facilis cum perferendis.
              Sunt explicabo ipsum temporibus nemo, vero dignissimos voluptatum non eaque minima. Nulla minus voluptatem velit dolorum eos vitae quod impedit debitis itaque,
              quaerat beatae cum possimus neque dolore sit ex laudantium inventore nemo magnam consequatur nostrum. Inventore nostrum iusto molestiae.
              Eos maiores harum veniam! Rem architecto suscipit blanditiis modi. Eaque facilis alias doloremque! Cumque aspernatur adipisci minus eos numquam iure molestias amet ipsam.
              Dolore, accusamus? Voluptatibus asperiores molestiae, expedita recusandae excepturi cum a, impedit magni at, nostrum sint?
              Beatae necessitatibus at autem ut! Nesciunt eveniet commodi, recusandae, odit nostrum animi sapiente sed repellendus facilis,
              ullam similique possimus facere ut. Commodi quia id enim minima aperiam.
            </p>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Tempora labore, autem quae eaque recusandae aliquid animi adipisci? Alias qui et cumque, magnam doloribus,
              itaque atque blanditiis debitis ut tenetur porro architecto ab earum inventore omnis vitae error.
              Mollitia veniam autem quas itaque corporis maiores a, atque alias dolore amet. Dolor minima magni nemo in.
              Enim explicabo quia error perferendis mollitia id consequuntur adipisci quis, neque iusto pariatur magnam repudiandae,
              omnis consectetur! Mollitia voluptatibus fugit doloribus libero iusto consequatur ipsam? Consequatur commodi et eveniet voluptatibus optio nam!
              Enim ab dolores perspiciatis quasi, quam ea impedit et magnam nulla modi ipsum fugiat libero!
              Laudantium voluptatum, cumque mollitia quas autem similique nisi earum doloremque impedit nam ab necessitatibus, porro obcaecati,
              facere tempora voluptates nulla omnis recusandae aspernatur quam! Voluptas eum recusandae qui impedit temporibus nesciunt tempora voluptatibus aperiam facere?
              Aut dicta impedit blanditiis consequuntur molestiae debitis assumenda laboriosam rem, illum hic facilis velit.
            </p>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit.
              Rerum explicabo, sit laborum delectus rem aspernatur officia voluptatibus dolore! Dolorum quia consequatur eveniet magnam nam provident,
              libero illo necessitatibus, doloribus, quas consequuntur. Sint facere,
              reiciendis dignissimos magnam molestias neque libero itaque esse nemo expedita eligendi qui repellat at unde tempora laboriosam?
            </p>
          </div>
          <!-- DISPLAY WRITTEN ARTICLE BODY, SECTION END -->
          <!-- RATE THIS, SECTION START -->
          <div class="lv-con-pg-articles-view-rate">
            <p>
              Rate this:
              <rate v-model="myRate"
                    :length="5"
                    :value="0"
                    :showcount="true"
                    :ratedesc="[
                      $t('user.blog_page.rating_system.very_bad'),
                      $t('user.blog_page.rating_system.bad'),
                      $t('user.blog_page.rating_system.normal'),
                      $t('user.blog_page.rating_system.good'),
                      $t('user.blog_page.rating_system.very_good')
                    ]"
                    @after-rate="onAfterRate"
              />
            </p>
          </div>
          <!-- RATE THIS, SECTION END -->
          <!-- SHARE THIS, SECTION START -->
          <div class="lv-con-pg-articles-view-share">
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_page.social_menu.like')">
              <fa :icon="['fa', 'thumbs-up']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_page.social_menu.dislike')">
              <fa :icon="['fa', 'thumbs-down']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_page.social_menu.facebook')">
              <fa :icon="['fab', 'facebook']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_page.social_menu.instagram')">
              <fa :icon="['fab', 'instagram']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.blog_page.social_menu.email')">
              <fa :icon="['fa', 'envelope']" fixed-width />
            </a>
          </div>
          <!-- SHARE THIS, SECTION END -->
          <!-- COMMENTS, SECTION START -->
          <div class="comment-divider" />
          <div class="lv-con-pg-articles-view-comments">
            <!-- COMMENT FORM, SECTION START -->
            <div class="container-comment-form">
              <div class="container-comment-form-main">
                <form @submit.prevent="commentArticle" @keydown="form.onKeydown($event)">
                  <alert-success :form="form" :message="message_success" />
                  <!-- FULL NAME, SECTION START -->
                  <div class="mb-2">
                    <input id="full_name"
                           v-model="form.full_name"
                           type="text"
                           :class="{ 'is-invalid': form.errors.has('full_name') }"
                           class="form-control"
                           :placeholder="$t('user.blog_page.comment_form.input_full_name')"
                           name="full_name"
                    >
                    <has-error :form="form" field="full_name" />
                  </div>
                  <!-- FULL NAME, SECTION END -->
                  <!-- EMAIL ADDRESS, SECTION START -->
                  <div class="mb-2">
                    <input id="email"
                           v-model="form.email"
                           type="email"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           class="form-control"
                           :placeholder="$t('user.blog_page.comment_form.input_email_address')"
                           name="email"
                    >
                    <has-error :form="form" field="email" />
                  </div>
                  <!-- EMAIL ADDRESS, SECTION END -->
                  <!-- MESSAGE, SECTION START -->
                  <div class="mb-2">
                    <textarea id="message"
                              v-model="form.message"
                              :class="{ 'is-invalid': form.errors.has('email') }"
                              class="form-control form-message"
                              :placeholder="$t('user.blog_page.comment_form.input_message')"
                              name="message"
                    />
                    <has-error :form="form" field="message" />
                  </div>
                  <!-- MESSAGE, SECTION END -->
                  <!-- PRIVACY POLICY, SECTION START -->
                  <div class="my-2 form-check">
                    <input id="privacy_policy"
                           v-model="form.privacy_policy"
                           type="checkbox"
                           :class="{ 'is-invalid': form.errors.has('privacy_policy') }"
                           class="form-check-input"
                           name="privacy_policy"
                    >
                    <label class="form-check-label lead" for="flexCheckChecked">
                      {{ $t('user.blog_page.comment_form.i_agree_with') }}
                      <router-link :to="{ name: 'home-page' }">{{ $t('user.blog_page.comment_form.privacy_policy') }}</router-link>
                    </label>
                    <has-error :form="form" field="privacy_policy" />
                  </div>
                  <!-- PRIVACY POLICY, SECTION END -->
                  <div class="form-button">
                    <button type="submit" class="btn btn-primary">
                      {{ $t('user.blog_page.comment_form.post_comment') }}
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <!-- COMMENT FORM, SECTION END -->
          </div>
          <!-- COMMENTS, SECTION END -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import rate from 'vue-rate'
import 'vue-rate/dist/vue-rate.css'
import Form from 'vform'

Vue.use(rate)

export default {
  name: 'WrittenArticlesPage',
  components: {},
  layout: '',
  middleware: '',
  props: {
    length: {
      type: Number,
      default: null
    },
    value: {
      type: Number,
      default: null
    },
    showcount: {
      type: Boolean,
      default: null
    },
    ratedesc: {
      type: String,
      default: null
    }
  },
  data: function () {
    return {
      myRate: 0,
      message_success: this.$t('user.contact-me-page.general.message_sent'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {
    onAfterRate () {
      console.log('Test')
    },
    async commentArticle () {
      const writtenArticleApi = '/api/written-article'
      const { data } = await this.form.post(writtenArticleApi)
      console.log('>>>>>> Written Article Api URL: ', data)
    }
  },
  metaInfo () {
    return { title: this.$t('user.article_blog_page.page_title') }
  }
}
</script>
