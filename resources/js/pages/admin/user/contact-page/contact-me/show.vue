<template>
  <!-- SHOW MESSAGE, SECTION START -->
  <div id="showMessage"
       class="modal fade"
       tabindex="-1"
       data-bs-backdrop="static"
       data-bs-keyboard="false"
       aria-labelledby="showMessageLabel"
       aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showMessageLabel" class="modal-title">
            Message from {{ showRow.full_name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <b>Full name:</b>
              {{ showRow.full_name }}
            </li>
            <li class="list-group-item">
              <b>Email address:</b>
              {{ showRow.email }}
            </li>
            <li class="list-group-item">
              <b>Contact message:</b>
              {{ showRow.message }}
            </li>
            <li class="list-group-item">
              <b>Privacy policy:</b>
              <span v-if="showRow.privacy_policy === '1'">
                Yes
              </span>
              <span v-else>
                No
              </span>
            </li>
            <li class="list-group-item">
              <b>Message sent at:</b>
              {{ new Date(showRow.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </li>
            <li v-if="showRow.message_status !== null" class="list-group-item">
              <b>Response message:</b>
              <span v-for="response in showRow.contact_me_responses" :key="response.id">
                {{ response.message_response }}
              </span>
            </li>
            <li v-else class="list-group-item">
              <b>Response message:</b>
              Currently you did not responded to {{ showRow.full_name }}.
              You can respond to this message by closing this window and clicking on 'Respond'.
            </li>
            <li v-if="showRow.message_status !== null" class="list-group-item">
              <b>Response sent at:</b>
              <span v-for="response in showRow.contact_me_responses" :key="response.id">
                {{ new Date(response.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- SHOW MESSAGE, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import axios from 'axios'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'ShowMessage',
  middleware: 'auth',
  props: {
    showRow: {
      default: null,
      type: Object
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfMessages: 'contact_me/listOfMessages'
    })
  }
}
</script>
