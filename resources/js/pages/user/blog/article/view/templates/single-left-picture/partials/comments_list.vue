<template>
  <!-- COMMENTS, SECTION START -->
  <div class="article-comments-list">
    <div v-if="blogArticleComments.length === 0" class="article-comments-list-info">
      <h1>{{ $t('user.blog_system_pages.general_settings.comment_section.no_comment_info') }}</h1>
    </div>
    <div v-for="articleComment in blogArticleComments" :key="articleComment.id" class="card article-comments-list-card">
      <div class="card-body">
        <h5 class="card-title">
          <span>{{ articleComment.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on') }}
          <span>{{ new Date(articleComment.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>:
        </h5>
        <p class="card-text">
          {{ articleComment.comment }}
        </p>
        <comment-reply-form :comment-id="articleComment.id" />
      </div>
    </div>
  </div>
  <!-- COMMENTS, SECTION END -->
</template>

<script>
import CommentReplyForm from './comment_reply_form.vue'

export default {
  name: 'SingleLeftPictureCommentListDetails',
  components: {
    CommentReplyForm
  },
  props: {
    blogArticleComments: {
      default: null,
      type: Array
    }
  }
}
</script>
