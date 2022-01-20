<template>
  <!-- COMMENTS, SECTION START -->
  <div class="audio-article-comments-list">
    <div v-if="blogArticleComments.length === 0" class="audio-article-comments-list-info">
      <h1>{{ $t('user.blog_system_pages.general_settings.comment_section.no_comment_info') }}</h1>
    </div>
    <div v-for="articleComment in blogArticleComments" :key="articleComment.id" class="card audio-article-comments-list-card">
      <div class="card-body">
        <h5 class="card-title">
          <span>{{ articleComment.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on') }}
          <span>{{ new Date(articleComment.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
        </h5>
        <p class="card-text">
          {{ articleComment.comment }}
        </p>
        <comment-reply-form :comment-id="articleComment.id" />
        <div v-if="articleComment.blog_article_comment_replies">
          <div v-for="articleCommentReply in articleComment.blog_article_comment_replies" :key="articleCommentReply.id" class="card audio-article-comments-list-reply-card">
            <div class="card-body">
              <h5 class="card-title">
                <span>{{ articleCommentReply.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_1') }}
                <span>{{ articleComment.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_2') }}
                <span>{{ new Date(articleCommentReply.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
              </h5>
              <p class="card-text">
                {{ articleCommentReply.comment_reply }}
              </p>
              <reply-to-comment-reply-form :comment-reply-id="articleCommentReply.id" />
              <div v-if="articleCommentReply.blog_article_comment_reply_replies">
                <div v-for="articleReplyToCommentReply in articleCommentReply.blog_article_comment_reply_replies" :key="articleReplyToCommentReply.id" class="card audio-article-comments-list-reply-card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <span>{{ articleReplyToCommentReply.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_1') }}
                      <span>{{ articleCommentReply.full_name }}</span> {{ $t('user.blog_system_pages.general_settings.comment_section.added_on_alternative.line_2') }}
                      <span>{{ new Date(articleReplyToCommentReply.created_at).toLocaleDateString('ro-RO', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                    </h5>
                    <p class="card-text">
                      {{ articleReplyToCommentReply.reply_to_comment_reply }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- COMMENTS, SECTION END -->
</template>

<script>
import CommentReplyForm from './comment_reply_form.vue'
import ReplyToCommentReplyForm from './reply_to_comment_reply_form.vue'

export default {
  name: 'SingleLeftPictureCommentListDetails',
  components: {
    CommentReplyForm,
    ReplyToCommentReplyForm
  },
  props: {
    blogArticleComments: {
      default: null,
      type: Array
    }
  }
}
</script>
