<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-body">
          <vue-good-table
            :columns="columns"
            :rows="displayListOfMessages"
            :search-options="{
              enabled: true
            }"
            :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 50,
              position: 'bottom',
              perPageDropdown: [100, 200, 300, 400, 500],
              dropdownAllowAll: false,
              setCurrentPage: 1,
              jumpFirstOrLast : true,
              firstLabel : 'First Page',
              lastLabel : 'Last Page',
              nextLabel: 'next',
              prevLabel: 'prev',
              rowsPerPageLabel: 'Rows per page',
              ofLabel: 'of',
              pageLabel: 'page',
              allLabel: 'All',
            }"
          >
            <div slot="table-actions">
              <button v-if="user.user_role_type_id === 1" class="btn btn-danger me-2" @click="deleteAllMessages()">
                <fa icon="trash" fixed-width /> Delete all
              </button>
            </div>
            <template slot="table-row" slot-scope="props">
              <span v-if="props.column.field == 'created_at'">
                {{ new Date(props.formattedRow['created_at']).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
              <span v-else-if="props.column.field == 'actions'">
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-info w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage"
                        @click="showMessage(props.row)"
                >
                  <fa icon="eye" fixed-width /> Show
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-success w-100"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#respondMessage"
                        @click="respondMessage(props.row)"
                >
                  <fa icon="pencil-alt" fixed-width /> Respond
                </button>
                <button v-if="user.user_role_type_id === 1 || user.user_role_type_id === 2"
                        class="btn btn-danger w-100"
                        @click="deleteMessage(props.row)"
                >
                  <fa icon="trash" fixed-width /> Delete
                </button>
              </span>
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>
          </vue-good-table>
        </div>

        <show-message :show-row="selectedData" />

        <!-- RESPOND TO MESSAGE, SECTION START -->
        <div id="respondMessage"
             class="modal fade"
             tabindex="-1"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             aria-labelledby="respondMessageLabel"
             aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="respondMessageLabel" class="modal-title">
                  Respond to {{ selectedData.full_name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
              </div>
              <div class="modal-body">
                <ul class="list-group">
                  <li class="list-group-item">
                    <b>Full name:</b>
                    {{ selectedData.full_name }}
                  </li>
                  <li class="list-group-item">
                    <b>Email address:</b>
                    {{ selectedData.email }}
                  </li>
                  <li class="list-group-item">
                    <b>Contact message:</b>
                    {{ selectedData.message }}
                  </li>
                  <li class="list-group-item">
                    <b>Privacy policy:</b>
                    <span v-if="selectedData.privacy_policy === '1'">
                      Yes
                    </span>
                    <span v-else>
                      No
                    </span>
                  </li>
                  <li class="list-group-item">
                    <b>Message sent at:</b>
                    {{ new Date(selectedData.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                  </li>
                  <li v-if="selectedData.message_status === null" class="list-group-item">
                    <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
                      <div class="col col-12 my-3">
                        <label class="col-form-label">
                          <b>Respond to message:</b>
                        </label>
                        <textarea id="message_response"
                                  v-model="form.message_response"
                                  type="text"
                                  :class="{ 'is-invalid': form.errors.has('message_response') }"
                                  class="form-control"
                                  name="message_response"
                                  rows="8"
                                  style="resize:none"
                        />
                        <has-error :form="form" field="message_response" />
                      </div>
                      <div class="modal-buttons">
                        <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                          Respond
                        </button>
                      </div>
                    </form>
                  </li>
                  <li v-else class="list-group-item">
                    <b>Respond to message:</b>
                    You already have responded to {{ selectedData.full_name }}.
                    To view your response close this window and click on 'Show'.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- RESPOND TO MESSAGE, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import Vuex, { mapGetters, mapActions } from 'vuex'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { VueGoodTable } from 'vue-good-table'
import Form from 'vform'
import 'vue-good-table/dist/vue-good-table.css'
import ShowMessage from './show'

Vue.use(axios)
Vue.use(Vuex)

window.axios = require('axios')

export default {
  name: 'AdminContactMeMessages',
  components: {
    VueGoodTable,
    ShowMessage
  },
  middleware: 'auth',
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Full Name',
          field: 'full_name'
        },
        {
          label: 'Email',
          field: 'email'
        },
        {
          label: 'Contact message',
          field: 'message'
        },
        {
          label: 'Privacy Policy',
          field: 'privacy_policy',
          hidden: true
        },
        {
          label: 'Message sent at',
          field: 'created_at'
        },
        {
          label: 'Response message',
          field: 'contact_me_responses',
          hidden: true
        },
        {
          label: 'Actions',
          field: 'actions',
          sortable: false
        }
      ],
      selectedData: {},
      form: new Form({
        contact_me_id: 0,
        message_response: ''
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      listOfMessages: 'contact_me/listOfMessages'
    }),
    displayListOfMessages () {
      return this.listOfMessages.records
    },
    getHttpStatusResponseCode () {
      // TODO Blog System: How to catch api endpoint errors and display them to the user
      return this.listOfMessages.http_response_code
    }
  },
  created () {
    this.fetchListOfMessages()
  },
  methods: {
    ...mapActions({
      fetchListOfMessages: 'contact_me/fetchListOfMessages'
    }),
    async showMessage (row) {
      this.selectedData = row
      console.log('> selectedData: ', this.selectedData)
      console.log('> selectedData message_status: ', typeof this.selectedData.message_status)
      if (this.selectedData.message_status !== 'null') {
        console.log('> you did not responded to this user')
      }
      return this.selectedData
    },
    async respondMessage (row) {
      this.selectedData = row
      return this.selectedData
    },
    async edit () {
      if (!this.user) {
        Swal.fire({
          title: 'Unauthenticated User Title',
          text: 'Unauthenticated User Text Message',
          confirmButtonText: 'Login',
          showCancelButton: true,
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          } else {
            this.form.message_response = ''
          }
        })
      } else {
        const url = window.location.origin
        this.form.contact_me_id = this.selectedData.id
        const apiEndPoint = '/api/admin/system/contact-me/respond'
        const fullApiUrl = url + apiEndPoint
        try {
          await this.form.post(fullApiUrl, {
            contact_me_id: this.form.contact_me_id,
            message_response: this.form.message_response
          })
            .then(response => {
              console.log('> response message: ')
              this.$refs.close.click()
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                this.form.message_response = ''
                window.location.reload()
              })
            })
        } catch (err) {
          if (err.response.status === 500) {
            console.log('> error message: ')
            this.$refs.close.click()
            Swal.fire({
              title: err.response.data.title,
              html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>'
            })
          }
        }
      }
    },
    async deleteMessage (row) {
      if (!this.user) {
        Swal.fire({
          title: 'Unauthenticated User Title',
          text: 'Unauthenticated User Text Message',
          confirmButtonText: 'Login',
          showCancelButton: true,
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/contact-me'
        const urlParam = row.id
        const fullApiUrl = url + apiEndPoint + '/' + urlParam
        try {
          await axios.delete(fullApiUrl, { id: urlParam })
            .then(response => {
              console.log('> response message: ')
              Swal.fire({
                title: response.data.title,
                html:
                    '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                    '<p>' + response.data.description + '</p>'
              }).then((result) => {
                console.log('> result message: ')
                window.location.reload()
              })
            })
        } catch (err) {
          if (err.response.status === 500) {
            console.log('> error message: ')
            Swal.fire({
              title: err.response.data.title,
              html:
                  '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                  '<p>' + err.response.data.description + '</p>'
            })
          }
        }
      }
    },
    async deleteAllMessages () {
      if (!this.user) {
        Swal.fire({
          title: 'Unauthenticated User Title',
          text: 'Unauthenticated User Text Message',
          confirmButtonText: 'Login',
          showCancelButton: true,
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$router.push({ name: 'user.auth.login' })
          }
        })
      } else {
        const url = window.location.origin
        const apiEndPoint = '/api/admin/system/contact-me/delete-all'
        const fullApiUrl = url + apiEndPoint
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            try {
              axios.delete(fullApiUrl)
                .then(response => {
                  console.log('> response message: ')
                  Swal.fire({
                    title: response.data.title,
                    html:
                        '<p>Notify code: ' + '<a href="' + response.data.reference + '">' + response.data.notify_code + '</a>' + '</p>' +
                        '<p>' + response.data.description + '</p>'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      console.log('> result message: ')
                      window.location.reload()
                    }
                  })
                })
            } catch (err) {
              if (err.response.status === 500) {
                console.log('> error message: ')
                Swal.fire({
                  title: err.response.data.title,
                  html:
                      '<p>Notify code: ' + '<a href="' + err.response.data.reference + '">' + err.response.data.notify_code + '</a>' + '</p>' +
                      '<p>' + err.response.data.description + '</p>'
                })
              }
            }
          }
        })
      }
    }
  },
  metaInfo () {
    return { title: 'Admin - Contact Me Messages' }
  }
}
</script>
