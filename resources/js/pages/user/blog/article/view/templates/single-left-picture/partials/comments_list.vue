<template>
  <!-- COMMENTS, SECTION START -->
  <div class="article-comments-list">
    <div v-if="!blogArticleComments" class="article-comments-list-info">
      <h1>Fi primul care lasa un comentariu!</h1>
    </div>
    <div v-for="articleComment in blogArticleComments" :key="articleComment.id" class="card article-comments-list-card">
      <div class="card-body">
        <h5 class="card-title">
          <span>{{ articleComment.full_name }}</span> a adăugat un comentariu pe
          <span>{{ new Date(articleComment.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>:
        </h5>
        <p class="card-text">
          {{ articleComment.comment }}
        </p>
        <div class="form-button">
          <button class="btn btn-primary" @click="showCommentForm = !showCommentForm">
            <span v-if="!showCommentForm">Răspunde</span>
            <span v-else>Anulează</span>
          </button>
        </div>
        <div v-show="showCommentForm">
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
        <div v-if="articleComment.blog_article_comment_replies">
          <div v-for="articleCommentReply in articleComment.blog_article_comment_replies" :key="articleCommentReply.id" class="card article-comments-list-reply-card">
            <div class="card-body">
              <h5 class="card-title">
                <span>{{ articleCommentReply.full_name }}</span> i-a răspuns lui
                <span>{{ articleComment.full_name }}</span> pe
                <span>{{ new Date(articleCommentReply.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </h5>
              <p class="card-text">
                {{ articleCommentReply.comment_reply }}
              </p>
              <div class="form-button">
                <button class="btn btn-primary" @click="showReplyCommentForm = !showReplyCommentForm">
                  <span v-if="!showReplyCommentForm">Răspunde</span>
                  <span v-else>Anulează</span>
                </button>
              </div>
              <div v-show="showReplyCommentForm">
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
        </div>
      </div>
    </div>
  </div>
  <!-- COMMENTS, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Form from 'vform'
import axios from 'axios'

Vue.use(axios)
window.axios = require('axios')

export default {
  name: 'SingleLeftPictureCommentListDetails',
  props: {
    blogArticleComments: {
      default: null,
      type: Array
    }
  },
  data: function () {
    return {
      showCommentForm: false,
      showReplyCommentForm: false,
      message_success: this.$t('user.blog_system_pages.written_article_blog_pages.article_blog_page.comment_form.success_message'),
      form: new Form({
        full_name: '',
        email: '',
        comment: '',
        privacy_policy: false
      })
    }
  }
}
</script>
