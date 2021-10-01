<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-articles">
        <div class="lv-con-pg-articles-title">
          <h1>TITLUL ARTICOLULUI SCRIS</h1>
        </div>
        <div class="lv-con-pg-articles-view">
          <!-- ARTICLE TEMPLATE, SECTION START -->
          <!-- <single-left-picture /> -->
          <single-right-picture />
          <!-- <single-bottom-picture /> -->
          <!-- ARTICLE TEMPLATE, SECTION END -->
          <!-- RATE THIS, SECTION START -->
          <div class="lv-con-pg-articles-view-rate">
            <p>
              {{ $t('user.article_blog_page.rating_system.title') }}
              <rate v-model="myRate"
                    :length="5"
                    :value="0"
                    :showcount="true"
                    :ratedesc="[
                      $t('user.article_blog_page.rating_system.options.very_bad'),
                      $t('user.article_blog_page.rating_system.options.bad'),
                      $t('user.article_blog_page.rating_system.options.normal'),
                      $t('user.article_blog_page.rating_system.options.good'),
                      $t('user.article_blog_page.rating_system.options.very_good')
                    ]"
                    @after-rate="onAfterRate"
              />
            </p>
          </div>
          <!-- RATE THIS, SECTION END -->
          <!-- ARTICLE SUBCATEGORY, SECTION START -->
          <div class="lv-con-pg-articles-view-subcategory">
            <p>
              {{ $t('user.article_blog_page.article_subcategory') }}:
              &nbsp;
              <a href="">Subcategorie 1</a>
            </p>
          </div>
          <!-- ARTICLE SUBCATEGORY, SECTION END -->
          <!-- SHARE THIS, SECTION START -->
          <div class="lv-con-pg-articles-view-share">
            <a class="btn btn-primary"
               target="_blank"
               :title="$t('user.article_blog_page.social_menu.like')"
               @click="articleLike"
            >
              <fa :icon="['fa', 'thumbs-up']" fixed-width /> {{ countLikes }} {{ $t('user.article_blog_page.like_dislike_system.like') }}
            </a>
            <a class="btn btn-primary"
               target="_blank"
               :title="$t('user.article_blog_page.social_menu.dislike')"
               @click="articleDislikes"
            >
              <fa :icon="['fa', 'thumbs-down']" fixed-width /> {{ countDislikes }} {{ $t('user.article_blog_page.like_dislike_system.dislike') }}
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.article_blog_page.social_menu.facebook')">
              <fa :icon="['fab', 'facebook']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.article_blog_page.social_menu.instagram')">
              <fa :icon="['fab', 'instagram']" fixed-width />
            </a>
            <a href="" class="btn btn-primary" target="_blank" :title="$t('user.article_blog_page.social_menu.email')">
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
                           :placeholder="$t('user.article_blog_page.comment_form.input_full_name')"
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
                           :placeholder="$t('user.article_blog_page.comment_form.input_email_address')"
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
                              :placeholder="$t('user.article_blog_page.comment_form.input_message')"
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
                      <span @click="acceptPrivacyPolicy">
                        {{ $t('user.article_blog_page.comment_form.i_agree_with') }}
                        <span class="a-typography"
                              @click="redirectToPrivacyPolicy"
                        >
                          {{ $t('user.article_blog_page.comment_form.privacy_policy') }}
                        </span>
                      </span></label>
                    <has-error :form="form" field="privacy_policy" />
                  </div>
                  <!-- PRIVACY POLICY, SECTION END -->
                  <div class="form-button">
                    <button type="submit" class="btn btn-primary">
                      {{ $t('user.article_blog_page.comment_form.post_comment') }}
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

// import SingleLeftPicture from '../templates/SingleLeftPicture'
// import SingleRightPicture from '../templates/SingleRightPicture.vue'
// import SingleBottomPicture from '../templates/SingleBottomPicture.vue'

Vue.use(rate)

export default {
  name: 'WrittenArticlesPage',
  components: {
    // SingleLeftPicture,
    // SingleRightPicture
    // SingleBottomPicture
  },
  layout: '',
  middlewa: '',
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
      countLikes: 0,
      countDislikes: 0,
      message_success: this.$t('user.article_blog_page.comment_form.success_message'),
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
    articleLike () {
      this.countLikes += 1
    },
    articleDislikes () {
      this.countDislikes += 1
    },
    async commentArticle () {
      const writtenArticleApi = '/api/written-article'
      const { data } = await this.form.post(writtenArticleApi)
      console.log('>>>>>> Written Article Api URL: ', data)
    },
    acceptPrivacyPolicy () {
      if (this.form.privacy_policy === true) {
        this.form.privacy_policy = false
      } else {
        this.form.privacy_policy = true
      }
    },
    redirectToPrivacyPolicy () {
      this.$router.push({ name: 'terms-and-conditions' })
    }
  },
  metaInfo () {
    return { title: this.$t('user.article_blog_page.page_title') }
  }
}
</script>
