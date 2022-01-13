<template>
  <div class="article-comments">
    <!-- COMMENT FORM, SECTION START -->
    <div class="article-comments-form">
      <div class="article-comments-form-main">
        <div class="form-button">
          <button class="btn btn-primary" @click="showForm = !showForm">
            <span v-if="!showForm">Scrie un comentariu</span>
            <span v-else>Anulează</span>
          </button>
        </div>
        <div v-show="showForm">
          <form @submit.prevent="commentArticle" @keydown="form.onKeydown($event)">
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
              <label class="form-check-label lead" for="flexCheckChecked">
                <span>
                  {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.i_agree_with') }}
                  <router-link class="a-typography" to="/terms-and-conditions">
                    {{ $t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.privacy_policy') }}
                  </router-link>
                </span>
              </label>
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

Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'SingleLeftPictureCommentFormDetails',
  data: function () {
    return {
      showForm: false,
      message_success: this.$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.success_message'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  }
}
</script>
