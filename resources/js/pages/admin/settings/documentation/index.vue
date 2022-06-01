<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN DOCUMENTATION PAGE</h1>
        </div>
        <div class="lv-pg-admin-body">
          <h1>BODY HERE</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminDocumentation',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin' }
  }
}
</script>
