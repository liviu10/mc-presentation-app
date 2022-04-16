<template>
  <!-- SHOW BLOG CATEGORY, SECTION START -->
  <div id="showBlogArticle"
       class="modal fade"
       tabindex="-1"
       data-bs-backdrop="static"
       data-bs-keyboard="false"
       aria-labelledby="showBlogArticleLabel"
       aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showBlogArticleLabel" class="modal-title">
            Blog category title "{{ showRow.blog_article_title }}"
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <b>Article author:</b>
              {{ showRow.blog_article_author }}
            </li>
            <li class="list-group-item">
              <b>Article read / listen / video time:</b>
              {{ showRow.blog_article_time }} minutes
            </li>
            <li class="list-group-item">
              <b>Article short description:</b>
              {{ showRow.blog_article_short_description }}
            </li>
            <li class="list-group-item">
              <b>Status:</b>
              <span v-if="showRow.blog_article_is_active === '1'">
                Article is active
              </span>
              <span v-else>
                Article is not active
              </span>
            </li>
            <li class="list-group-item">
              <b>Appreciation:</b>
              <span v-if="getBlogArticleLikes === false && getBlogArticleDislikes === false && getBlogArticleRate === false">
                0 likes,
                0 dislikes,
                0 rate
              </span>
              <span v-else-if="getBlogArticleLikes === false && getBlogArticleDislikes === true && getBlogArticleRate === true">
                0 likes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} dislikes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} rate
              </span>
              <span v-else-if="getBlogArticleLikes === true && getBlogArticleDislikes === false && getBlogArticleRate === false">
                {{ showRow.blog_article_like.blog_article_likes }} likes,
                0 dislikes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} rate
              </span>
              <span v-else-if="getBlogArticleLikes === true && getBlogArticleDislikes === true && getBlogArticleRate === false">
                {{ showRow.blog_article_like.blog_article_likes }} likes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} dislikes,
                0 rate
              </span>
              <span v-else>
                {{ showRow.blog_article_like.blog_article_likes }} likes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} dislikes,
                {{ showRow.blog_article_dislike.blog_article_dislikes }} rate
              </span>
            </li>
            <li class="list-group-item">
              <b>Article URL:</b>
              <span>
                <a :href="locationUrl + '' + showRow.blog_article_path + '/' + showRow.id" target="_blank">
                  {{ showRow.blog_article_title }}
                  <span class="ms-1">
                    <fa :icon="['fa', 'external-link-alt']" fixed-width />
                  </span>
                </a>
              </span>
            </li>
            <li class="list-group-item">
              <b>Date created:</b>
              {{ new Date(showRow.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- SHOW BLOG CATEGORY, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import axios from 'axios'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'ShowBlogArticle',
  middleware: 'auth',
  props: {
    showRow: {
      default: null,
      type: Object
    },
    locationUrl: {
      default: null,
      type: String
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),
    getBlogArticleLikes () {
      if (this.showRow.blog_article_like && this.showRow.blog_article_like.length) {
        return true
      }
      return false
    },
    getBlogArticleDislikes () {
      if (this.showRow.blog_article_dislike && this.showRow.blog_article_dislike.length) {
        return true
      }
      return false
    },
    getBlogArticleRate () {
      if (this.showRow.blog_article_rate && this.showRow.blog_article_rate.length) {
        return true
      }
      return false
    }
  }
}
</script>
