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
        <reply-to-new-comment-form :comment-id="articleComment.id"
                                   :comment-likes="articleComment.blog_article_comment_like"
                                   :comment-dislikes="articleComment.blog_article_comment_dislike"
        />
        <div v-if="articleComment.blog_article_comment_replies.length" class="video-article-comments-list-show">
          <button class="btn btn-primary text-center" @click="displayCommentReplies()">
            <span v-if="!showCommentReplies">
              <fa :icon="['fa', 'angle-down']" fixed-width />&nbsp;
              {{ $t('user.blog_system_pages.general_settings.comment_section.show_comment_replies') }}
            </span>
            <span v-else>
              <fa :icon="['fa', 'angle-up']" fixed-width />&nbsp;
              {{ $t('user.blog_system_pages.general_settings.comment_section.hide_comment_replies') }}
            </span>
          </button>
        </div>
        <div v-show="showCommentReplies">
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
                <respond-to-comment-reply-form :comment-reply-id="articleCommentReply.id"
                                               :comment-reply-likes="articleCommentReply.blog_article_comment_reply_like"
                                               :comment-reply-dislikes="articleCommentReply.blog_article_comment_reply_dislike"
                />
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
  },
  data: function () {
    return {
      showCommentReplies: false
    }
  },
  methods: {
    displayCommentReplies () {
      this.showCommentReplies = !this.showCommentReplies
    }
  }
}
</script>
