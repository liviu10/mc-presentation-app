<template>
  <!-- DISPLAY LOG DETAILS, SECTION START -->
  <div id="showLogs"
       class="modal fade"
       tabindex="-1"
       data-bs-backdrop="static"
       data-bs-keyboard="false"
       aria-labelledby="showLogsLabel"
       aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showLogsLabel" class="modal-title">
            Application log details
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <b>Status:</b> {{ showRow.status }}
            </li>
            <li class="list-group-item">
              <b>Status description:</b> {{ showRow.status_description }}
            </li>
            <li class="list-group-item">
              <b>Request details:</b> {{ showRow.request_details }}
            </li>
            <li class="list-group-item">
              <b>Response details:</b> {{ showRow.response_details }}
            </li>
            <li v-if="showRow.logable_id && showRow.logable_type" class="list-group-item">
              <b>Data model:</b> {{ showRow.logable_type }} (record id: {{ showRow.logable_id }})
            </li>
            <li class="list-group-item">
              <b>Logged at:</b> {{ new Date(showRow.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- DISPLAY LOG DETAILS, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import axios from 'axios'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'ShowLogs',
  middleware: 'auth',
  props: {
    showRow: {
      default: null,
      type: Object
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>
