<template>
  <div class="audio-article-body-content">
    <p>
      {{ firstBlogArticleContentSection }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'BodyDetails',
  props: {
    firstBlogArticleContentSection: {
      default: null,
      type: String
    }
  }
}
</script>
