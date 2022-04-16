<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-blog">
        <!-- MAIN CATEGORIES, SECTION START -->
        <main-categories />
        <!-- MAIN CATEGORIES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import MainCategories from './partials/MainCategories.vue'

export default {
  name: 'Blog',
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.page_title') }
  },
  components: {
    MainCategories
  }
}
</script>
