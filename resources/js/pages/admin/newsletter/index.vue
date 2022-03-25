<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN NEWSLETTER</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                CAMPAIGNS
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-newsletter-campaigns-page' }" class="btn btn-primary">
                View
              </router-link>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                SUBSCRIBERS
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-newsletter-subscribers-page' }" class="btn btn-primary">
                View
              </router-link>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                LOGS
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-newsletter-logs-page' }" class="btn btn-primary">
                View
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminNewsletter',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Newsletter Campaign' }
  }
}
</script>
