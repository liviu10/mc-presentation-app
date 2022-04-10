<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN CONTACT ME MESSAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#contact_me_messages" class="nav-link active" data-bs-toggle="tab">Contact me Message</a>
              </li>
              <li class="nav-item">
                <a href="#contact_me_message_settings" class="nav-link" data-bs-toggle="tab">Contact me Settings</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="contact_me_messages" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <admin-contact-me-messages />
                  </div>
                </div>
              </div>
              <div id="contact_me_message_settings" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <admin-contact-me-settings />
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
import AdminContactMeMessages from './contact-me/index.vue'
import AdminContactMeSettings from './settings/index.vue'

Vue.use(Vuex)

export default {
  name: 'AdminNewsletter',
  components: {
    AdminContactMeMessages,
    AdminContactMeSettings
  },
  middleware: 'auth',
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  metaInfo () {
    return { title: 'Admin - Contact me messages' }
  }
}
</script>
