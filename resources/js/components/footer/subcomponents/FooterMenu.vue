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
    <div id="exampleModal"
         class="modal fade"
         tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
         data-bs-backdrop="static"
    >
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
                <input id="unsubscribe_email"
                       v-model="form.email"
                       type="email"
                       class="form-control"
                       :placeholder="$t('user.footer.footer_menu.unsubscribe_newsletter.modal_unsubscribe.input_placeholder')"
                       name="email"
                >
                <span v-if="wrongEmailInputErrorMessage" style="color: #FF0000">
                  {{ wrongEmailInputErrorMessage }}
                </span>
                <span v-else />
                <span v-if="emptyEmailInputErrorMessage" style="color: #FF0000">
                  {{ emptyEmailInputErrorMessage }}
                </span>
                <span v-else />
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
import Form from 'vform'
import Swal from 'sweetalert2/dist/sweetalert2.js'

export default {
  name: 'FooterMenu',
  data: function () {
    return {
      form: new Form({
        email: ''
      }),
      wrongEmailInputErrorMessage: '',
      emptyEmailInputErrorMessage: '',
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
              '</a>' + '&nbsp;&nbsp;  &nbsp;&nbsp;' +
              '<a href="https://www.youtube.com/channel/UCvyAUdyF4qG1j6S8IX67W5A/featured" target="_blank" rel="noreferrer" class="btn btn-primary">' +
                'Youtube' +
              '</a>',
            showConfirmButton: false
          })
        })
        .catch(error => {
          if (error.response.status === 500) {
            this.wrongEmailInputErrorMessage = this.$t('user.footer.footer_menu.unsubscribe_newsletter.wrong_email_input')
          }
          if (error.response.status === 405) {
            this.emptyEmailInputErrorMessage = this.$t('user.footer.footer_menu.unsubscribe_newsletter.empty_email_input')
          }
        })
    }
  }
}
</script>
