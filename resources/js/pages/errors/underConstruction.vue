<template>
  <div class="lv-pg-under-construction">
    <!-- UNDER CONSTRUCTION PAGE ACTIONS, SECTION START -->
    <div class="lv-pg-under-construction-action">
      <div class="action-body">
        <img src="/images/error/under-construction_img.jpg" alt="">
      </div>
      <div class="lv-pg-under-construction-action-buttons">
        <!-- UNDER CONSTRUCTION PAGE TITLE, SECTION START -->
        <div class="title">
          <h3>
            {{ $t('error_pages.under_construction_page.title') }}
          </h3>
        </div>
        <!-- UNDER CONSTRUCTION PAGE TITLE, SECTION END -->
        <!-- UNDER CONSTRUCTION PAGE BUTTONS, SECTION START -->
        <div class="buttons">
          <router-link :to="{ name: 'home-page' }"
                       class="btn btn-primary"
          >
            {{ $t('error_pages.under_construction_page.action.first') }}
          </router-link>
          <a class="btn btn-primary" @click="goToPreviousPage">
            {{ $t('error_pages.under_construction_page.action.second') }}
          </a>
        </div>
        <!-- UNDER CONSTRUCTION PAGE BUTTONS, SECTION END -->
      </div>
    </div>
    <!-- UNDER CONSTRUCTION PAGE ACTIONS, SECTION END -->
  </div>
</template>

<script>
export default {
  name: 'UnderConstructionPage',
  data: function () {
    return {}
  },
  methods: {
    goToPreviousPage () {
      return this.$router.go(-1)
    }
  }
}
</script>
