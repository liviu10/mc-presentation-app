<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-blog">
        <!-- MAIN CATEGORIES, SECTION START -->
        <main-categories />
        <!-- MAIN CATEGORIES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
import MainCategories from '~/pages/user/blog/partials/MainCategories.vue'

export default {
  name: 'BlogPage',
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.meta_title') }
  },
  components: {
    MainCategories
  }
}
</script>
