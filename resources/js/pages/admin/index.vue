<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-home">
        <div class="lv-pg-admin-home-header">
          <h1>{{ $t('admin.home_page.page_title') }}</h1>
        </div>
        <div class="lv-pg-admin-home-body" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Admin',
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('admin.home_page.page_title') }
  }
}
</script>
