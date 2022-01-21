<template>
  <div>
    <div class="form-button">
      <button class="btn btn-primary" @click="showReplyToCommentReplyForm = !showReplyToCommentReplyForm">
        <span v-if="!showReplyToCommentReplyForm">{{ $t('user.blog_system_pages.general_settings.comment_section.open_reply_comment_form') }}</span>
        <span v-else @click="clearReplyCommentReplyForm">{{ $t('user.blog_system_pages.general_settings.comment_section.close_reply_comment_form') }}</span>
      </button>
    </div>
    <div v-show="showReplyToCommentReplyForm">
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
          <textarea id="comment_reply"
                    v-model="form.comment_reply"
                    :class="{ 'is-invalid': form.errors.has('comment_reply') }"
                    class="form-control form-message"
                    :placeholder="$t('user.blog_system_pages.general_settings.comment_section.comment_form.input_comment')"
                    name="comment_reply"
          />
          <has-error :form="form" field="comment_reply" />
        </div>
        <!-- MESSAGE, SECTION END -->
        <!-- PRIVACY POLICY, SECTION START -->
        <div class="my-2 form-check">
          <input id="privacy_policy"
                 v-model="form.privacy_policy_comment_reply"
                 type="checkbox"
                 :class="{ 'is-invalid': form.errors.has('privacy_policy_comment_reply') }"
                 class="form-check-input"
                 name="privacy_policy_comment_reply"
          >
          <label class="form-check-label lead" for="privacy_policy_comment_reply">
            {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.i_agree_with') }}
          </label>
          <a class="lead a-typography" href="/terms-and-conditions">
            {{ $t('user.blog_system_pages.general_settings.comment_section.comment_form.privacy_policy') }}
          </a>
          <has-error :form="form" field="privacy_policy_comment_reply" />
        </div>
        <!-- PRIVACY POLICY, SECTION END -->
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
  name: 'ReplyToCommentReplyForm',
  props: {
    commentReplyId: {
      default: null,
      type: Number
    }
  },
  data: function () {
    return {
      showReplyToCommentReplyForm: false,
      form: new Form({
        blog_article_comment_reply_id: this.commentReplyId,
        full_name: '',
        email: '',
        reply_to_comment_reply: '',
        // reply_to_comment_reply_is_public: false,
        privacy_policy_reply_to_comment_reply: false
      }),
      fullName: ''
    }
  },
  methods: {
    clearReplyCommentReplyForm () {
      if (this.form.full_name === '' || this.form.email === '' || this.form.reply_to_comment_reply === '' || this.form.reply_to_comment_reply_is_public === true || this.form.privacy_policy_reply_to_comment_reply === true) {
        this.form.full_name = ''
        this.form.email = ''
        this.form.reply_to_comment_reply = ''
        // this.form.reply_to_comment_reply_is_public = ''
        this.form.privacy_policy_reply_to_comment_reply = false
      }
    },
    async replyToCommentReply () {
      const url = window.location.origin
      const apiEndPoint = '/api/blog/response-to-reply'
      const fullApiUrl = url + apiEndPoint
      await this.form
        .post(fullApiUrl, {
          blogArticleCommentId: this.form.blog_article_comment_reply_id,
          full_name: this.form.full_name,
          email: this.form.email,
          reply_to_comment_reply: this.form.reply_to_comment_reply,
          // reply_to_comment_reply_is_public: this.form.reply_to_comment_reply_is_public,
          privacy_policy: this.form.privacy_policy_reply_to_comment_reply
        })
        .then(response => {
          this.fullName = response.data.full_name
          Swal.fire({
            title: this.$t('user.blog_system_pages.general_settings.comment_section.swal.title', { fullName: this.fullName }),
            text: this.$t('user.blog_system_pages.general_settings.comment_section.swal.message')
          }).then((result) => {
            console.log(result)
            this.form.full_name = null
            this.form.email = null
            this.form.comment_reply = null
            // this.form.comment_reply_is_public = null
            this.form.privacy_policy_comment_reply = null
            this.showReplyToCommentForm = false
          })
        })
    }
  }
}
</script>
