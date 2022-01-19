<template>
  <div v-if="articleContent">
    <!-- TEMPLATE TITLE, SECTION START -->
    <single-left-picture-header-details :blog-article-author="articleContent.blog_articles[0].blog_article_author"
                                        :blog-article-created="articleContent.blog_articles[0].created_at"
                                        :blog-article-updated="articleContent.blog_articles[0].updated_at"
                                        :blog-article-reading-time="articleContent.blog_articles[0].blog_article_time"
    />
    <!-- TEMPLATE TITLE, SECTION END -->
    <div class="title-divider" />
    <!-- TEMPLATE BODY, SECTION START -->
    <single-left-picture-body-details :blog-article-content="articleContent.blog_articles[0].blog_article_content" />
    <!-- TEMPLATE BODY, SECTION END -->
    <!-- TEMPLATE OPTIONS (RATE, SUBCATEGORY TITLE AND SHARE BUTTONS), SECTION START -->
    <single-left-picture-option-details :blog-article-rating="articleContent.blog_articles[0].blog_article_rating_system"
                                        :blog-article-subcategory-title="articleContent.blog_subcategory_title"
                                        :blog-article-subcategory-path="articleContent.blog_subcategory_path"
                                        :blog-article-likes="articleContent.blog_articles[0].blog_article_likes"
                                        :blog-article-dislikes="articleContent.blog_articles[0].blog_article_dislikes"
    />
    <!-- TEMPLATE OPTIONS (RATE, SUBCATEGORY TITLE AND SHARE BUTTONS), SECTION END -->
    <div class="comment-divider" />
    <!-- TEMPLATE COMMENT FORM, SECTION START -->
    <single-left-picture-comment-form-details :blog-article-id="articleContent.blog_articles[0].id" />
    <!-- TEMPLATE COMMENT FORM, SECTION END -->
    <!-- TEMPLATE COMMENTS LIST, SECTION START -->
    <single-left-picture-comment-list-details :blog-article-comments="articleContent.blog_articles[0].blog_article_comments" />
    <!-- TEMPLATE COMMENTS LIST, SECTION END -->
  </div>
</template>

<script>
import SingleLeftPictureHeaderDetails from './partials/header.vue'
import SingleLeftPictureBodyDetails from './partials/body.vue'
import SingleLeftPictureOptionDetails from './partials/options.vue'
import SingleLeftPictureCommentFormDetails from './partials/comment_form.vue'
import SingleLeftPictureCommentListDetails from './partials/comments_list.vue'

export default {
  name: 'SingleLeftPicture',
  components: {
    SingleLeftPictureHeaderDetails,
    SingleLeftPictureBodyDetails,
    SingleLeftPictureOptionDetails,
    SingleLeftPictureCommentFormDetails,
    SingleLeftPictureCommentListDetails
  },
  props: {
    articleContent: {
      default: null,
      type: Object
    }
  }
}
</script>
