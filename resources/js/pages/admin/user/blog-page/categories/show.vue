<template>
  <!-- SHOW BLOG CATEGORY, SECTION START -->
  <div id="showBlogCategory"
       class="modal fade"
       tabindex="-1"
       data-bs-backdrop="static"
       data-bs-keyboard="false"
       aria-labelledby="showBlogCategoryLabel"
       aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showBlogCategoryLabel" class="modal-title">
            Blog category title "{{ showRow.blog_category_title }}"
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <b>Category short description:</b>
              {{ showRow.blog_category_short_description }}
            </li>
            <li class="list-group-item">
              <b>Status:</b>
              <span v-if="showRow.blog_category_is_active === '1'">
                Category is active
              </span>
              <span v-else>
                Category is not active
              </span>
            </li>
            <li class="list-group-item">
              <b>Category URL:</b>
              <span>
                <a :href="locationUrl + '' + showRow.blog_category_path" target="_blank">
                  {{ showRow.blog_category_title }}
                </a>
              </span>
              <span class="ms-1">
                <fa :icon="['fa', 'external-link-alt']" fixed-width />
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
  name: 'ShowBlogCategory',
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
    })
  }
}
</script>
