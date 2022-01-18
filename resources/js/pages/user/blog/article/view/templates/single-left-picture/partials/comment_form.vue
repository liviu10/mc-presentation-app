<template>
  <div class="article-comments">
    <!-- COMMENT FORM, SECTION START -->
    <div class="article-comments-form">
      <div class="article-comments-form-main">
        <div class="form-button">
          <button class="btn btn-primary" @click="showAddCommentForm = !showAddCommentForm">
            <span v-if="!showAddCommentForm">{{ $t('user.blog_system_pages.general_settings.comment_section.open_add_comment_form') }}</span>
            <span v-else @click="clearAddCommentForm">{{ $t('user.blog_system_pages.general_settings.comment_section.close_add_comment_form') }}</span>
          </button>
        </div>
        <div v-show="showAddCommentForm">
          <form @submit.prevent="addNewComment" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="message_success" />
            <!-- FULL NAME, SECTION START -->
            <div class="mb-2">
              <input id="full_name"
                     v-model="form.full_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('full_name') }"
                     class="form-control"
                     :placeholder="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.input_full_name')"
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
                     :placeholder="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.input_email_address')"
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
                        :placeholder="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.input_message')"
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
              <label class="form-check-label lead" for="privacy_policy">
                {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.i_agree_with') }}
              </label>
              <a class="lead a-typography" href="/terms-and-conditions">
                {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.privacy_policy') }}
              </a>
              <has-error :form="form" field="privacy_policy" />
            </div>
            <!-- PRIVACY POLICY, SECTION END -->
            <div class="form-button">
              <button type="submit" class="btn btn-primary">
                {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.post_comment') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- COMMENT FORM, SECTION END -->
  </div>
</template>

<script>
import Vue from 'vue'
import Form from 'vform'
import axios from 'axios'
import Swal from 'sweetalert2/dist/sweetalert2.js'

Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'SingleLeftPictureCommentFormDetails',
  data: function () {
    return {
      showAddCommentForm: false,
      message_success: this.$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.success_message'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  methods: {
    clearAddCommentForm () {
      if (this.form.full_name === '' || this.form.email === '' || this.form.message === '' || this.form.privacy_policy === true) {
        this.form.full_name = ''
        this.form.email = ''
        this.form.message = ''
        this.form.privacy_policy = false
      }
    },
    async addNewComment () {
      console.log('> Create API endpoint for adding a new comment:')
      // const url = window.location.origin
      // const apiEndPoint = '/api/subscribe'
      // const fullApiUrl = url + apiEndPoint
      // await this.form
      //   .post(fullApiUrl, {
      //     full_name: this.form.full_name,
      //     email: this.form.email,
      //     privacy_policy: this.form.privacy_policy
      //   })
      //   .then(response => {
      //     this.subscriberFullName = response.data.full_name
      //     Swal.fire({
      //       title: this.$t('user.home_page.newsletter.swal.title', { subscriberFullName: this.subscriberFullName }),
      //       text: this.$t('user.home_page.newsletter.swal.message'),
      //       imageUrl: this.displayRandomNewsletterImage(this.newsletterImages),
      //       imageWidth: 259,
      //       imageHeight: 194
      //     }).then((result) => {
      //       console.log(result)
      //       this.form.full_name = null
      //       this.form.email = null
      //       this.form.privacy_policy = null
      //     })
      //   })
    }
  }
}
</script>
