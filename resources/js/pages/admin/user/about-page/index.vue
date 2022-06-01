<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-about">
        <div class="lv-pg-admin-about-header">
          <h1>USER ABOUT ME</h1>
        </div>
        <div class="lv-pg-admin-about-body">
          <h1>BODY HERE</h1>
        </div>
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
