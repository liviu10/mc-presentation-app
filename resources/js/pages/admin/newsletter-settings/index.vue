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
              <li class="nav-item">
                <a href="#newsletter_reports" class="nav-link" data-bs-toggle="tab">Newsletter Reports</a>
              </li>
              <li class="nav-item">
                <a href="#newsletter_settings" class="nav-link" data-bs-toggle="tab">Newsletter Settings</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="newsletter_campaigns" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <admin-newsletter-campaigns />
                  </div>
                </div>
              </div>
              <div id="newsletter_subscribers" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-newsletter-subscribers />
                  </div>
                </div>
              </div>
              <div id="newsletter_reports" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-newsletter-reports />
                  </div>
                </div>
              </div>
              <div id="newsletter_settings" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-newsletter-settings />
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
import AdminNewsletterCampaigns from './campaigns/index.vue'
import AdminNewsletterSubscribers from './subscribers/index.vue'
import AdminNewsletterReports from './reports/index.vue'
import AdminNewsletterSettings from './settings/index.vue'

export default {
  name: 'AdminNewsletter',
  components: {
    AdminNewsletterCampaigns,
    AdminNewsletterSubscribers,
    AdminNewsletterReports,
    AdminNewsletterSettings
  },
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Newsletter Settings' }
  }
}
</script>
