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
                <a href="#logs" class="nav-link" data-bs-toggle="tab">Logs</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="accepted_domains" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      Accepted Domains
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-accepted-domains-page' }" class="btn btn-primary">
                      View
                    </router-link>
                  </div>
                </div>
              </div>
              <div id="errors_and_notifications" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      Errors And Notifications
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-errors-and-notifications-page' }" class="btn btn-primary">
                      View
                    </router-link>
                  </div>
                </div>
              </div>
              <div id="logs" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      Logs
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-logs-page' }" class="btn btn-primary">
                      View
                    </router-link>
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
export default {
  name: 'AdminApplicationSettings',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Application Settings' }
  }
}
</script>
