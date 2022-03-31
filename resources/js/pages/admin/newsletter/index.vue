<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN NEWSLETTER</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#newsletter_campaigns" class="nav-link active" data-bs-toggle="tab">Newsletter Campaigns</a>
              </li>
              <li class="nav-item">
                <a href="#newsletter_subscribers" class="nav-link" data-bs-toggle="tab">Newsletter Subscribers</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="newsletter_campaigns" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      Newsletter Campaigns
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-newsletter-campaigns-page' }" class="btn btn-primary">
                      View
                    </router-link>
                  </div>
                </div>
              </div>
              <div id="newsletter_subscribers" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      Newsletter Subscribers
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-newsletter-subscribers-page' }" class="btn btn-primary">
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
  name: 'AdminNewsletter',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Newsletter Campaign' }
  }
}
</script>
