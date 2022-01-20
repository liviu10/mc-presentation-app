<template>
  <div v-if="articleContent">
    <!-- TEMPLATE TITLE, SECTION START -->
    <header-details :blog-article-author="articleContent.blog_articles[0].blog_article_author"
                    :blog-article-created="articleContent.blog_articles[0].created_at"
                    :blog-article-updated="articleContent.blog_articles[0].updated_at"
                    :blog-article-reading-time="articleContent.blog_articles[0].blog_article_time"
    />
    <!-- TEMPLATE TITLE, SECTION END -->
    <div class="title-divider" />
    <!-- TEMPLATE VIDEO PLAYER, SECTION START -->
    <video-player-details :blog-article-title="articleContent.blog_articles[0].blog_article_title"
                          :blog-article-author="articleContent.blog_articles[0].blog_article_author"
                          :blog-article-video-path="articleContent.blog_articles[0].blog_article_video_path"
    />
    <!-- TEMPLATE VIDEO PLAYER, SECTION END -->
    <!-- TEMPLATE BODY, SECTION START -->
    <body-details :blog-article-content="articleContent.blog_articles[0].blog_article_short_description" />
    <!-- TEMPLATE BODY, SECTION END -->
    <!-- TEMPLATE OPTIONS (RATE, SUBCATEGORY TITLE AND SHARE BUTTONS), SECTION START -->
    <option-details :blog-article-rating="articleContent.blog_articles[0].blog_article_rating_system"
                    :blog-article-subcategory-title="articleContent.blog_subcategory_title"
                    :blog-article-subcategory-path="articleContent.blog_subcategory_path"
                    :blog-article-likes="articleContent.blog_articles[0].blog_article_likes"
                    :blog-article-dislikes="articleContent.blog_articles[0].blog_article_dislikes"
    />
    <!-- TEMPLATE OPTIONS (RATE, SUBCATEGORY TITLE AND SHARE BUTTONS), SECTION END -->
    <div class="comment-divider" />
    <!-- TEMPLATE COMMENT FORM, SECTION START -->
    <comment-form-details :blog-article-id="articleContent.blog_articles[0].id" />
    <!-- TEMPLATE COMMENT FORM, SECTION END -->
    <!-- TEMPLATE COMMENTS LIST, SECTION START -->
    <comment-list-details :blog-article-comments="articleContent.blog_articles[0].blog_article_comments" />
    <!-- TEMPLATE COMMENTS LIST, SECTION END -->
  </div>
</template>

<script>
import HeaderDetails from './partials/header.vue'
import VideoPlayerDetails from './partials/video_player.vue'
import BodyDetails from './partials/body.vue'
import OptionDetails from './partials/options.vue'
import CommentFormDetails from './partials/comment_form.vue'
import CommentListDetails from './partials/comments_list.vue'

export default {
  name: 'SingleVideoArticle',
  components: {
    HeaderDetails,
    VideoPlayerDetails,
    BodyDetails,
    OptionDetails,
    CommentFormDetails,
    CommentListDetails
  },
  props: {
    articleContent: {
      default: null,
      type: Object
    }
  }
}
</script>
