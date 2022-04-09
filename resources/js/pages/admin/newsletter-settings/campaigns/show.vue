<template>
  <!-- EDIT CAMPAIGN, SECTION START -->
  <div id="showCampaign" class="modal fade" tabindex="-1" aria-labelledby="showCampaignLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showCampaignLabel" class="modal-title">
            "{{ showRow.campaign_name }}" campaign details
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <b>Campaign description:</b>
              {{ showRow.campaign_description }}
            </li>
            <li class="list-group-item">
              <b>Status:</b>
              <span v-if="showRow.campaign_is_active === '1'">
                Campaign is active
              </span>
              <span v-else>
                Campaign is not active
              </span>
            </li>
            <li class="list-group-item">
              <b>Valid from:</b>
              {{ new Date(showRow.valid_from).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              <b>until:</b>
              {{ new Date(showRow.valid_to).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </li>
            <li class="list-group-item">
              <b>Date created:</b>
              {{ new Date(showRow.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </li>
            <li class="list-group-item">
              <b>Occurrence:</b>
              <span v-if="showRow.occur_times && showRow.occur_when && showRow.occur_day && showRow.occur_hour">
                {{ showRow.occur_times }} times per
                <span v-if="showRow.occur_when === '1'">
                  Day,
                </span>
                <span v-else-if="showRow.occur_when === '2'">
                  Week,
                </span>
                <span v-else>
                  Month,
                </span>
                on
                <span v-if="showRow.occur_day === '1'">
                  Monday
                </span>
                <span v-else-if="showRow.occur_day === '2'">
                  Tuesday
                </span>
                <span v-else-if="showRow.occur_day === '3'">
                  Wednesday
                </span>
                <span v-else-if="showRow.occur_day === '4'">
                  Thursday
                </span>
                <span v-else-if="showRow.occur_day === '5'">
                  Friday
                </span>
                <span v-else-if="showRow.occur_day === '6'">
                  Saturday
                </span>
                <span v-else>
                  Sunday,
                </span>
                at
                <span>
                  {{ showRow.occur_hour }}
                </span>
              </span>
              <span v-else>
                &#8212;
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- EDIT USER, SECTION END -->
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import axios from 'axios'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'ShowCampaign',
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
