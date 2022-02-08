<template>
  <div>
    <div class="form-button">
      <!-- <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.like')"
         @click="likeTheComment()"
      >
        <span>
          <fa :icon="['fa', 'thumbs-up']" fixed-width /> {{ blogCommentReplyLikes }} {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.like_dislike_system.like') }}
        </span>
      </a>
      <a class="btn btn-primary"
         target="_blank"
         :title="$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.social_menu.dislike')"
         @click="dislikeTheComment()"
      >
        <span>
          <fa :icon="['fa', 'thumbs-down']" fixed-width /> {{ blogCommentReplyDislikes }} {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.like_dislike_system.dislike') }}
        </span>
      </a> -->
      <button class="btn btn-primary" @click="showRespondToCommentReplyForm = !showRespondToCommentReplyForm">
        <span v-if="!showRespondToCommentReplyForm">{{ $t('user.blog_system_pages.general_settings.comment_section.open_reply_comment_form') }}</span>
        <span v-else @click="clearRespondToCommentReplyForm">{{ $t('user.blog_system_pages.general_settings.comment_section.close_reply_comment_form') }}</span>
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
    blogCommentReplyLikes: {
      default: null,
      type: Number
    },
    blogCommentReplyDislikes: {
      default: null,
      type: Number
    }
  },
  data: function () {
    return {
      showRespondToCommentReplyForm: false,
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
  methods: {
    clearRespondToCommentReplyForm () {
      if (this.form.full_name !== '' || this.form.email !== '' || this.form.respond_to_comment_reply !== '' || this.form.respond_to_comment_reply_is_public !== true || this.form.privacy_policy_respond_to_comment_reply !== true) {
        this.form.full_name = ''
        this.form.email = ''
        this.form.respond_to_comment_reply = ''
        this.form.respond_to_comment_reply_is_public = ''
        this.form.privacy_policy_respond_to_comment_reply = false
      }
    },
    async replyToCommentReply () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/comment/respond-to-reply'
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
            title: this.$t('user.blog_system_pages.general_settings.comment_section.swal.title', { fullName: this.fullName }),
            text: this.$t('user.blog_system_pages.general_settings.comment_section.swal.message')
          }).then((result) => {
            console.log(result)
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
