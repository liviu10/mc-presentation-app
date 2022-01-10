<template>
  <!-- COMMENTS, SECTION START -->
  <div class="article-comments-list">
    <div v-if="!blogArticleComments" class="article-comments-list-info">
      <h1>Fi primul care lasa un comentariu!</h1>
    </div>
    <div v-for="articleComment in blogArticleComments" :key="articleComment.id" class="card">
      <div class="card-body">
        <h5 class="card-title">
          {{ articleComment.full_name }}
        </h5>
        <p class="card-text">
          {{ articleComment.comment }}
        </p>
        <div v-if="articleComment.blog_article_comment_replies">
          <div v-for="articleCommentReply in articleComment.blog_article_comment_replies" :key="articleCommentReply.id" class="card">
            <div class="card-body">
              <h5 class="card-title">
                {{ articleCommentReply.full_name }}
              </h5>
              <p class="card-text">
                {{ articleCommentReply.comment_reply }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- COMMENTS, SECTION END -->
</template>

<script>
export default {
  name: 'SingleLeftPictureCommentListDetails',
  props: {
    blogArticleComments: {
      default: null,
      type: Array
    }
  }
}
</script>
