<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN ERRORS AND NOTIFICATIONS PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createErrorAndNotification">
            Create
          </button>
          <div v-for="errorAndNotification in displayListOfErrorsAndNotifications" :key="errorAndNotification.id" class="card">
            <div class="card-body">
              <h5 class="card-title">
                {{ errorAndNotification.notify_code }}
              </h5>
              <p class="card-text">
                <a :href="errorAndNotification.notify_reference">{{ errorAndNotification.notify_reference }}</a>
              </p>
              <p class="card-text">
                {{ errorAndNotification.notify_short_description }}
              </p>
              <button class="btn btn-primary"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#editErrorAndNotification"
                      @click="editErrorAndNotification(errorAndNotification)"
              >
                Edit
              </button>
            </div>
          </div>

          <new-accepted-domains />

          <edit-error-and-notification :edit-row="selectedDataToEdit" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import NewAcceptedDomains from './new'
import EditErrorAndNotification from './edit'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminErrorsAndNotifications',
  components: {
    NewAcceptedDomains,
    EditErrorAndNotification
  },
  middleware: 'auth',
  data: function () {
    return {
      selectedDataToEdit: {}
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfErrorsAndNotifications: 'errors_and_notifications/listOfErrorsAndNotifications'
    }),
    displayListOfErrorsAndNotifications () {
      return this.listOfErrorsAndNotifications.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfErrorsAndNotifications.http_response_code
    }
  },
  created () {
    this.fetchListOfErrorsAndNotifications()
  },
  methods: {
    ...mapActions({
      fetchListOfErrorsAndNotifications: 'errors_and_notifications/fetchListOfErrorsAndNotifications'
    }),
    async editErrorAndNotification (errorAndNotification) {
      this.selectedDataToEdit = errorAndNotification
      return this.selectedDataToEdit
    }
  },
  metaInfo () {
    return { title: 'Admin - Errors and Notifications' }
  }
}
</script>
