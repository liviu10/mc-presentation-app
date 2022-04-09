<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN APPLICATION SETTINGS PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#accepted_domains" class="nav-link active" data-bs-toggle="tab">Accepted Domains</a>
              </li>
              <li class="nav-item">
                <a href="#errors_and_notifications" class="nav-link" data-bs-toggle="tab">Errors And Notifications</a>
              </li>
              <li class="nav-item">
                <a href="#users_list" class="nav-link" data-bs-toggle="tab">Users List</a>
              </li>
              <li class="nav-item">
                <a href="#logs" class="nav-link" data-bs-toggle="tab">Logs</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="accepted_domains" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <admin-accepted-domains />
                  </div>
                </div>
              </div>
              <div id="errors_and_notifications" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-errors-and-notifications />
                  </div>
                </div>
              </div>
              <div id="users_list" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-user-list />
                  </div>
                </div>
              </div>
              <div id="logs" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-logs />
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
import AdminAcceptedDomains from './accepted-domains/index.vue'
import AdminErrorsAndNotifications from './errors-and-notifications/index.vue'
import AdminUserList from './user-list/index.vue'
import AdminLogs from './logs/index.vue'

export default {
  name: 'AdminApplicationSettings',
  components: {
    AdminAcceptedDomains,
    AdminErrorsAndNotifications,
    AdminUserList,
    AdminLogs
  },
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Application Settings' }
  }
}
</script>
