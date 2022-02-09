<template>
  <!-- COMMENTS, SECTION START -->
  <div class="video-article-comments-list">
    <div v-if="blogArticleComments.length === 0" class="video-article-comments-list-info">
      <h1>{{ $t('user.blog_system_pages.general_settings.comment_section.no_comment_info') }}</h1>
    </div>
    <div v-for="articleComment in blogArticleComments" :key="articleComment.id" class="card video-article-comments-list-card">
      <div class="card-body">
        <h5 class="card-title">
          <span>{{ articleComment.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on') }}
          <span>{{ new Date(articleComment.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
        </h5>
        <p class="card-text">
          {{ articleComment.comment }}
        </p>
        <reply-to-new-comment-form :comment-id="articleComment.id" :comment-like="articleComment.blogCommentLikes" :comment-dislike="articleComment.blogCommentDislikes" />
        <div v-if="articleComment.blog_article_comment_replies">
          <div v-for="articleCommentReply in articleComment.blog_article_comment_replies" :key="articleCommentReply.id" class="card video-article-comments-list-reply-card">
            <div class="card-body">
              <h5 class="card-title">
                <span>{{ articleCommentReply.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_1') }}
                <span>{{ articleComment.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_2') }}
                <span>{{ new Date(articleCommentReply.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </h5>
              <p class="card-text">
                {{ articleCommentReply.comment_reply }}
              </p>
              <!-- <respond-to-comment-reply-form :comment-reply-id="articleCommentReply.id" :comment-reply-like="articleCommentReply.blogCommentReplyLikes" :comment-reply-dislike="articleCommentReply.blogCommentReplyDislikes" /> -->
              <respond-to-comment-reply-form :comment-reply-id="articleCommentReply.id" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- COMMENTS, SECTION END -->
</template>

<script>
import ReplyToNewCommentForm from './reply_to_new_comment_form.vue'
import RespondToCommentReplyForm from './respond_to_comment_reply_form.vue'

export default {
  name: 'CommentListDetails',
  components: {
    ReplyToNewCommentForm,
    RespondToCommentReplyForm
  },
  props: {
    blogArticleComments: {
      default: null,
      type: Array
    }
  }
}
</script>
