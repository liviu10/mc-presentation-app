<template>
  <div>
    <div class="form-button">
      <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.general_settings.appreciation_menu.like')"
         @click="likeTheCommentReply()"
      >
        <span>
          <fa :icon="['fa', 'thumbs-up']" fixed-width />&nbsp;<span v-if="commentReplyLikes.length !== 0">{{ commentReplyLikes.length }}</span>
        </span>
      </a>
      <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.general_settings.appreciation_menu.dislike')"
         @click="dislikeTheCommentReply()"
      >
        <span>
          <fa :icon="['fa', 'thumbs-down']" fixed-width />&nbsp;<span v-if="commentReplyDislikes.length !== 0">{{ commentReplyDislikes.length }}</span>
        </span>
      </a>
      <button class="btn btn-primary" @click="displayRespondToCommentReplyForm()">
        <span v-if="!showRespondToCommentReplyForm">{{ $t('user.blog_system_pages.general_settings.comment_section.open_reply_comment_form') }}</span>
        <span v-else @click="clearRespondToCommentReplyForm()">{{ $t('user.blog_system_pages.general_settings.comment_section.close_reply_comment_form') }}</span>
      </button>
    </div>
    <div v-show="showRespondToCommentReplyForm">
      <form @submit.prevent="replyToCommentReply()" @keydown="form.onKeydown($event)">
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
          <textarea id="respond_to_comment_reply"
                    v-model="form.respond_to_comment_reply"
                    :class="{ 'is-invalid': form.errors.has('respond_to_comment_reply') }"
                    class="form-control form-message"
                    :placeholder="$t('user.blog_system_pages.general_settings.comment_section.comment_form.input_comment')"
                    name="respond_to_comment_reply"
          />
          <has-error :form="form" field="respond_to_comment_reply" />
        </div>
        <!-- MESSAGE, SECTION END -->
        <!-- PRIVACY POLICY, SECTION START -->
        <div class="my-2 form-check">
          <input id="privacy_policy_respond_to_comment_reply"
                 v-model="form.privacy_policy_respond_to_comment_reply"
                 type="checkbox"
                 :class="{ 'is-invalid': form.errors.has('privacy_policy_respond_to_comment_reply') }"
                 class="form-check-input"
                 name="privacy_policy_respond_to_comment_reply"
          >
          <label class="form-check-label lead" for="privacy_policy_respond_to_comment_reply">
            {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.i_agree_with') }}
          </label>
          <a class="lead a-typography" href="/terms-and-conditions">
            {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.privacy_policy') }}
          </a>
          <has-error :form="form" field="privacy_policy_respond_to_comment_reply" />
        </div>
        <!-- PRIVACY POLICY, SECTION END -->
        <!-- PUBLIC OR PRIVATE COMMENT, SECTION START -->
        <div class="my-2 form-check">
          <input id="respond_to_comment_reply_is_public"
                 v-model="form.respond_to_comment_reply_is_public"
                 type="checkbox"
                 :class="{ 'is-invalid': form.errors.has('respond_to_comment_reply_is_public') }"
                 class="form-check-input"
                 name="respond_to_comment_reply_is_public"
          >
          <label class="form-check-label lead" for="respond_to_comment_reply_is_public">
            {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.is_comment_public') }}
          </label>
          <has-error :form="form" field="respond_to_comment_reply_is_public" />
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
  name: 'RespondToCommentReplyForm',
  props: {
    commentReplyId: {
      default: null,
      type: Number
    },
    commentReplyLikes: {
      default: null,
      type: Array
    },
    commentReplyDislikes: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      showRespondToCommentReplyForm: false,
      disableFormInput: true,
      form: new Form({
        blog_article_comment_reply_id: this.commentReplyId,
        full_name: '',
        email: '',
        respond_to_comment_reply: '',
        respond_to_comment_reply_is_public: false,
        privacy_policy_respond_to_comment_reply: false
      }),
      fullName: ''
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    displayRespondToCommentReplyForm () {
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.add_comment'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          }
        })
      } else {
        this.showRespondToCommentReplyForm = !this.showRespondToCommentReplyForm
        this.form.full_name = this.user.name
        this.form.email = this.user.email
        this.disableFormInput = true
      }
    },
    clearRespondToCommentReplyForm () {
      if (this.form.full_name !== '' || this.form.email !== '' || this.form.respond_to_comment_reply !== '' || this.form.respond_to_comment_reply_is_public !== true || this.form.privacy_policy_respond_to_comment_reply !== true) {
        this.form.full_name = ''
        this.form.email = ''
        this.form.respond_to_comment_reply = ''
        this.form.respond_to_comment_reply_is_public = ''
        this.form.privacy_policy_respond_to_comment_reply = false
      }
    },
    async likeTheCommentReply () {
      let likeCommentReply = 0
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.comments'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            likeCommentReply = 0
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/blog/appreciate/like-comment-reply'
        const apiDeleteEndPoint = '/api/blog/appreciate/remove-like-comment-reply'
        const fullApiUrl = url + apiEndPoint
        const fullApiDeleteUrl = url + apiDeleteEndPoint
        const userName = this.user.name
        try {
          await axios.post(fullApiUrl, {
            user_id: this.user.id,
            blog_article_comment_reply_id: this.commentReplyId,
            blog_article_comment_reply_likes: likeCommentReply + 1
          })
            .then(response => {
              Swal.fire({
                title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
                text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.message')
              }).then((result) => {
                likeCommentReply = 0
                window.location.reload()
              })
            })
        } catch (error) {
          if (error.response.status === 406) {
            Swal.fire({
              title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
              text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.already_message'),
              showDenyButton: true,
              denyButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.deny_like')
            }).then((result) => {
              if (result.isDenied) {
                axios.delete(fullApiDeleteUrl, {
                  data: {
                    user_id: this.user.id,
                    blog_article_comment_reply_id: this.commentReplyId
                  }
                }).then((result) => {
                  window.location.reload()
                })
              }
            })
          }
        }
      }
    },
    async dislikeTheCommentReply () {
      let dislikeCommentReply = 0
      if (!this.user) {
        Swal.fire({
          title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.title'),
          text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.comments'),
          confirmButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.login_button'),
          showCancelButton: true,
          cancelButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article.cancel_button')
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            dislikeCommentReply = 0
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/blog/appreciate/dislike-comment-reply'
        const apiDeleteEndPoint = '/api/blog/appreciate/remove-dislike-comment-reply'
        const fullApiUrl = url + apiEndPoint
        const fullApiDeleteUrl = url + apiDeleteEndPoint
        const userName = this.user.name
        try {
          await axios.post(fullApiUrl, {
            user_id: this.user.id,
            blog_article_comment_reply_id: this.commentReplyId,
            blog_article_comment_reply_dislikes: dislikeCommentReply + 1
          })
            .then(response => {
              Swal.fire({
                title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
                text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.message')
              }).then((result) => {
                dislikeCommentReply = 0
                window.location.reload()
              })
            })
        } catch (error) {
          if (error.response.status === 406) {
            Swal.fire({
              title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: userName }),
              text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.already_message'),
              showDenyButton: true,
              denyButtonText: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.deny_like')
            }).then((result) => {
              if (result.isDenied) {
                axios.delete(fullApiDeleteUrl, {
                  data: {
                    user_id: this.user.id,
                    blog_article_comment_reply_id: this.commentReplyId
                  }
                }).then((result) => {
                  window.location.reload()
                })
              }
            })
          }
        }
      }
    },
    async replyToCommentReply () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/appreciate/respond-to-reply'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          blogArticleCommentId: this.form.blog_article_comment_reply_id,
          full_name: this.form.full_name,
          email: this.form.email,
          respond_to_comment_reply: this.form.respond_to_comment_reply,
          respond_to_comment_reply_is_public: this.form.respond_to_comment_reply_is_public,
          privacy_policy: this.form.privacy_policy_respond_to_comment_reply
        })
        .then(response => {
          this.fullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.title', { fullName: this.fullName }),
            text: this.$t('user.blog_system_pages.general_settings.appreciation_menu.swal_article_positive.add_comment')
          }).then((result) => {
            if (this.form.comment_reply_is_public === true) {
              window.location.reload()
            }
            this.form.full_name = null
            this.form.email = null
            this.form.comment_reply = null
            this.form.comment_reply_is_public = null
            this.form.privacy_policy_comment_reply = null
            this.showRespondToCommentReplyForm = false
          })
        })
    }
  }
}
</script>
