<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <written-list-articles />
    </div>
  </div>
</template>

<script>
import WrittenListArticles from '~/pages/user/blog/partials/WrittenListArticles.vue'

export default {
  name: 'WrittenArticles',
  components: {
    WrittenListArticles
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.written_article_blog_pages.page_title') }
  }
}
</script>
