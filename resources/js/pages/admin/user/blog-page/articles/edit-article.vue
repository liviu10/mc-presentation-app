<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-edit-article">
        <div class="lv-pg-admin-edit-article-header">
          <h1>ADMIN EDIT BLOG ARTICLES</h1>
        </div>
        <div class="lv-pg-admin-edit-article-body">
          <h1>BODY HERE</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminBlogArticlesEdit',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - User Edit Blog Article' }
  }
}
</script>
