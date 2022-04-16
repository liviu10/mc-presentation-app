<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN APPLICATION LOGS</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#application_logs" class="nav-link active" data-bs-toggle="tab">Application Logs</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="application_logs" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <admin-application-logs />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Vuex, { mapGetters } from 'vuex'
import AdminApplicationLogs from './logs/index.vue'

Vue.use(Vuex)

export default {
  name: 'AdminNewsletter',
  components: {
    AdminApplicationLogs
  },
  middleware: 'auth',
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  metaInfo () {
    return { title: 'Admin - Application Logs' }
  }
}
</script>
