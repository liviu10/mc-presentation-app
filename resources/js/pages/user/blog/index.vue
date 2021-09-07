<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <h1>APP BLOG PAGE</h1>
      <!-- MAIN CATEGORIES, SECTION START -->
      <main-categories />
      <!-- MAIN CATEGORIES, SECTION END -->
    </div>
  </div>
</template>

<script>
import MainCategories from '~/pages/user/blog/partials/MainCategories.vue'

export default {
  name: 'BlogPage',
  components: {
    MainCategories
  }
}
</script>
