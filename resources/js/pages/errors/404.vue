<template>
  <div class="lv-con-pg-error page-not-found">
    <!-- ERROR PAGE ACTIONS, SECTION START -->
    <div class="page-not-found-action">
      <div class="action-body">
        <img src="/images/error/not-found_img.jpg" alt="">
      </div>
      <div class="page-not-found-action-buttons">
        <!-- ERROR PAGE TITLE, SECTION START -->
        <div class="title">
          <h3>
            {{ $t('error_pages.page_not_found.title') }}
          </h3>
        </div>
        <!-- ERROR PAGE TITLE, SECTION END -->
        <!-- ERROR PAGE BUTTONS, SECTION START -->
        <div class="buttons">
          <router-link v-for="action in actions"
                       :key="action.id"
                       :to="{ name: action.button_url }"
                       class="btn btn-primary"
          >
            {{ action.button_name }}
          </router-link>
        </div>
        <!-- ERROR PAGE BUTTONS, SECTION END -->
      </div>
    </div>
    <!-- ERROR PAGE ACTIONS, SECTION END -->
  </div>
</template>

<script>
export default {
  name: 'PageNotFound',
  data: function () {
    return {
      actions: [
        {
          id: 1,
          button_url: 'home-page',
          button_name: this.$t('error_pages.page_not_found.action.first')
        }
      ]
    }
  }
}
</script>
