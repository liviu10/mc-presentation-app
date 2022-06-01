<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-about-me">
        <div class="lv-pg-admin-about-me-header">
          <h1>USER PAGE: ABOUT ME</h1>
        </div>
        <div class="lv-pg-admin-about-me-body" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminUserAboutMePage',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - User About Me Page' }
  }
}
</script>
