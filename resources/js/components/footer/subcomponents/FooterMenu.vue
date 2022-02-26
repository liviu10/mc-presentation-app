i<template>
  <div class="container-footer-menu-button">
    <p v-for="footer_button in footer_buttons" :key="footer_button.id">
      <router-link v-if="footer_button.button_id === 'modalUnsubscribe'"
                   :to="{ name: footer_button.button_url }"
                   data-bs-toggle="modal"
                   data-bs-target="#exampleModal"
      >
        {{ footer_button.button_name }}
      </router-link>
      <router-link v-else :to="{ name: footer_button.button_url }">
        {{ footer_button.button_name }}
      </router-link>
    </p>
    <!-- UNSUBSCRIBE MODAL, SECTION START -->
    <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="exampleModalLabel" class="modal-title">
              {{ $t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.title') }}
            </h4>
          </div>
          <div class="modal-body">
            <p>
              {{ $t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.message') }}
            </p>
            <form @submit.prevent="unsubscribe" @keydown="form.onKeydown($event)">
              <div class="col col-12 my-3">
                <input id="email"
                       v-model="form.email"
                       type="email"
                       :class="{ 'is-invalid': form.errors.has('email') }"
                       class="form-control"
                       :placeholder="$t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.input_placeholder')"
                       name="email"
                >
                <has-error :form="form" field="email" />
              </div>
              <div class="modal-buttons">
                <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  {{ $t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.cancel_button') }}
                </button>
                <button type="submit" class="btn btn-primary">
                  {{ $t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.confirm_button') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- UNSUBSCRIBE MODAL, SECTION END -->
  </div>
</template>

<script>
// import Vue from 'vue'
// import axios from 'axios'

import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

// Vue.use(axios)

// window.axios = require('axios')

export default {
  name: 'FooterMenu',
  data: function () {
    return {
      form: new Form({
        email: ''
      }),
      footer_buttons: [
        {
          id: 1,
          button_url: 'terms-and-conditions',
          button_name: this.$t('user.footer.footer_menu.first_button'),
          button_id: ''
        },
        {
          id: 2,
          button_url: '',
          button_name: this.$t('user.footer.footer_menu.second_button'),
          button_id: 'modalUnsubscribe'
        }
      ]
    }
  },
  methods: {
    closeModal () {
      this.$refs.close.click()
    },
    async unsubscribe () {
      const url = window.location.origin
      const apiEndPoint = '/api/unsubscribe'
      const urlParam = this.form.email
      const fullApiUrl = url + apiEndPoint + '/' + urlParam
      await this.form
        .delete(fullApiUrl, { email: urlParam })
        .then(response => {
          this.form.email = ''
          this.closeModal()
          Swal.fire({
            title: this.$t('user.footer.footer_menu.unsubscribe_newsletter.swal_confirmation.title'),
            text: this.$t('user.footer.footer_menu.unsubscribe_newsletter.swal_confirmation.message'),
            timer: 18000,
            footer:
              '<a href="https://www.facebook.com/groups/269560668238590/?ref=share" target="_blank" rel="noreferrer" class="btn btn-primary">' +
                'Facebook' +
              '</a>',
            // '<a href="https://www.facebook.com/groups/269560668238590/?ref=share" target="_blank" rel="noreferrer" class="btn btn-primary">' +
            //   'Facebook' +
            // '</a>' + '&nbsp;&nbsp;  &nbsp;&nbsp;' +
            // '<a href="" target="_blank" rel="noreferrer" class="btn btn-primary">' +
            //   'Instagram' +
            // '</a>' + '&nbsp;&nbsp;  &nbsp;&nbsp;' +
            // '<a href="" target="_blank" rel="noreferrer" class="btn btn-primary">' +
            //   'Youtube' +
            // '</a>',
            // icon: 'success',
            showConfirmButton: false
          })
        })
    }
  }
}
</script>
