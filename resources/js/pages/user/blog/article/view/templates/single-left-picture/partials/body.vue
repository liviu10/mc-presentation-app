<template>
  <div class="article-body-content">
    <p />
    <div class="article-body-content-heading-slp">
      <img src="/images/pages/blog/articles/article-img-320x320-0.webp" alt="">
      <p>
        {{ firstBlogArticleContentSection }}
      </p>
    </div>
    <p>
      {{ secondBlogArticleContentSection }}
    </p>
    <p>
      {{ thirdBlogArticleContentSection }}
    </p>
    <p>
      {{ forthBlogArticleContentSection }}
    </p>
    <p>
      {{ fifthBlogArticleContentSection }}
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
    },
    secondBlogArticleContentSection: {
      default: null,
      type: String
    },
    thirdBlogArticleContentSection: {
      default: null,
      type: String
    },
    forthBlogArticleContentSection: {
      default: null,
      type: String
    },
    fifthBlogArticleContentSection: {
      default: null,
      type: String
    },
    blogArticleMediaUrl: {
      default: null,
      type: String
    }
  }
}
</script>
