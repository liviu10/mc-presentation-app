<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-contact-me">
        <div class="lv-pg-admin-contact-me-header">
          <h1>USER CONTACT ME MESSAGES</h1>
        </div>
        <div class="lv-pg-admin-contact-me-body">
          <div class="my-3">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#contact_me_messages" class="nav-link active" data-bs-toggle="tab">Contact me Message</a>
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

Vue.use(Vuex)

export default {
  name: 'AdminUserContactMeMessages',
  components: {
    AdminContactMeMessages
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
