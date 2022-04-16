<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN BLOG ARTICLE COMMENTS</h1>
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
  name: 'AdminBlogArticleComments',
  components: {},
  layout: '',
  middleware: 'auth',
  props: {},
  data: function () {
    return {}
  },
  computed: {
    // mapped getters}
  },
  mounted () {},
  methods: {},
  metaInfo () {
    return { title: 'Admin - User Blog Article Comments' }
  }
}
</script>
