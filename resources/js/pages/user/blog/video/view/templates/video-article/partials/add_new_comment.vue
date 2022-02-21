<template>
  <div class="video-article-comments">
    <!-- COMMENT FORM, SECTION START -->
    <div class="video-article-comments-form">
      <div class="video-article-comments-form-main">
        <div class="form-button">
          <button class="btn btn-primary" @click="displayAddNewCommentForm()">
            <span v-if="!showAddNewCommentForm">{{ $t('user.blog_system_pages.general_settings.comment_section.open_add_comment_form') }}</span>
            <span v-else @click="clearAddNewCommentForm()">{{ $t('user.blog_system_pages.general_settings.comment_section.close_add_comment_form') }}</span>
          </button>
        </div>
        <div v-show="showAddNewCommentForm">
          <form @submit.prevent="addNewComment()" @keydown="form.onKeydown($event)">
            <!-- FULL NAME, SECTION START -->
            <div class="mb-2">
              <input id="full_name"
                     v-model="form.full_name"
                     type="text"
                     :class="{ 'is-invalid': form.errors.has('full_name') }"
                     class="form-control"
                     :placeholder="$t('user.blog_system_pages.general_settings.comment_section.comment_form.input_full_name')"
                     name="full_name"
                     :disabled="disableFormInput"
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
                     :placeholder="$t('user.blog_system_pages.general_settings.comment_section.comment_form.input_email_address')"
                     name="email"
                     :disabled="disableFormInput"
              >
              <has-error :form="form" field="email" />
            </div>
            <!-- EMAIL ADDRESS, SECTION END -->
            <!-- MESSAGE, SECTION START -->
            <div class="mb-2">
              <textarea id="comment"
                        v-model="form.comment"
                        :class="{ 'is-invalid': form.errors.has('comment') }"
                        class="form-control form-message"
                        :placeholder="$t('user.blog_system_pages.general_settings.comment_section.comment_form.input_comment')"
                        name="comment"
              />
              <has-error :form="form" field="comment" />
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
                {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.i_agree_with') }}
              </label>
              <a class="lead a-typography" href="/terms-and-conditions">
                {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.privacy_policy') }}
              </a>
              <has-error :form="form" field="privacy_policy" />
            </div>
            <!-- PRIVACY POLICY, SECTION END -->
            <!-- PUBLIC OR PRIVATE COMMENT, SECTION START -->
            <div class="my-2 form-check">
              <input id="comment_is_public"
                     v-model="form.comment_is_public"
                     type="checkbox"
                     :class="{ 'is-invalid': form.errors.has('comment_is_public') }"
                     class="form-check-input"
                     name="comment_is_public"
              >
              <label class="form-check-label lead" for="comment_is_public">
                {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.is_comment_public') }}
              </label>
              <has-error :form="form" field="comment_is_public" />
            </div>
            <!-- PUBLIC OR PRIVATE COMMENT, SECTION END -->
            <div class="form-button">
              <button type="submit" class="btn btn-primary">
                {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.post_comment') }}
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
import { mapGetters } from 'vuex'
import Form from 'vform'
import axios from 'axios'
import Swal from 'sweetalert2/dist/sweetalert2.js'

Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'AddNewCommentForm',
  props: {
    blogArticleId: {
      default: null,
      type: Number
    }
  },
  data: function () {
    return {
      showAddNewCommentForm: false,
      disableFormInput: true,
      form: new Form({
        blog_article_id: this.blogArticleId,
        full_name: '',
        email: '',
        comment: '',
        comment_is_public: false,
        privacy_policy: false
      }),
      fullName: ''
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    displayAddNewCommentForm () {
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.rating_system.swal.title'),
          text: this.$t('user.blog_system_pages.general_settings.rating_system.swal.message'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.rating_system.swal.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.rating_system.swal.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          }
        })
      } else {
        this.showAddNewCommentForm = !this.showAddNewCommentForm
        this.form.full_name = this.user.name
        this.form.email = this.user.email
        this.disableFormInput = true
      }
    },
    clearAddNewCommentForm () {
      if (this.form.full_name !== '' || this.form.email !== '' || this.form.comment !== '' || this.form.comment_is_public !== true || this.form.privacy_policy !== true) {
        this.form.full_name = ''
        this.form.email = ''
        this.form.comment = ''
        this.form.comment_is_public = false
        this.form.privacy_policy = false
      }
    },
    async addNewComment () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/appreciate/add-new'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          blogArticleId: this.form.blog_article_id,
          full_name: this.form.full_name,
          email: this.form.email,
          comment: this.form.comment,
          comment_is_public: this.form.comment_is_public,
          privacy_policy: this.form.privacy_policy
        })
        .then(response => {
          this.fullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.blog_system_pages.general_settings.comment_section.swal.title', { fullName: this.fullName }),
            text: this.$t('user.blog_system_pages.general_settings.comment_section.swal.message')
          }).then((result) => {
            if (this.form.comment_is_public === true) {
              window.location.reload()
            }
            this.form.full_name = null
            this.form.email = null
            this.form.comment = null
            this.form.comment_is_public = null
            this.form.privacy_policy = null
            this.showAddNewCommentForm = false
          })
        })
    }
  }
}
</script>
