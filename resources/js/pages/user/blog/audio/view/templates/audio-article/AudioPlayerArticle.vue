<template>
  <div v-if="articleContent">
    <!-- TEMPLATE TITLE, SECTION START -->
    <header-details :blog-article-author="articleContent.blog_articles[0].blog_article_author"
                    :blog-article-created="articleContent.blog_articles[0].created_at"
                    :blog-article-updated="articleContent.blog_articles[0].updated_at"
                    :blog-article-audio-time="articleContent.blog_articles[0].blog_article_time"
                    :blog-article-comments="numberOfTotalComments()"
    />
    <!-- TEMPLATE TITLE, SECTION END -->
    <div class="title-divider" />
    <!-- TEMPLATE AUDIO PLAYER, SECTION START -->
    <audio-player-details :blog-article-title="articleContent.blog_articles[0].blog_article_title"
                          :blog-article-author="articleContent.blog_articles[0].blog_article_author"
                          :blog-article-audio-path="articleContent.blog_articles[0].blog_article_audio_path"
    />
    <!-- TEMPLATE AUDIO PLAYER, SECTION END -->
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
    <!-- TEMPLATE RELATED, SECTION START -->
    <!-- TODO: create a system for the blog article tags. the related articles will be linked to the current article via these tags -->
    <!-- <related-details :blog-related-articles="articleContent" /> -->
    <!-- TEMPLATE RELATED, SECTION END -->
    <div id="article_comments" class="comment-divider">
      <div class="line" />
      <span>{{ numberOfTotalComments() }}</span>
      <div class="line" />
    </div>
    <span v-if="numberOfTotalComments() === 1" class="comment-info">{{ $t('user.blog_system_pages.general_settings.comment_section.no_of_comments.singular') }}</span>
    <span v-if="numberOfTotalComments() > 1" class="comment-info">{{ $t('user.blog_system_pages.general_settings.comment_section.no_of_comments.plural') }}</span>
    <!-- TEMPLATE COMMENT FORM, SECTION START -->
    <add-new-comment-form :blog-article-id="articleContent.blog_articles[0].id" />
    <!-- TEMPLATE COMMENT FORM, SECTION END -->
    <!-- TEMPLATE COMMENTS LIST, SECTION START -->
    <comment-list-details :blog-article-comments="articleContent.blog_articles[0].blog_article_comments" />
    <!-- TEMPLATE COMMENTS LIST, SECTION END -->
  </div>
</template>

<script>
import HeaderDetails from './partials/header.vue'
import AudioPlayerDetails from './partials/audio_player.vue'
import BodyDetails from './partials/body.vue'
import OptionDetails from './partials/options.vue'
// import RelatedDetails from './partials/related.vue'
import AddNewCommentForm from './partials/add_new_comment.vue'
import CommentListDetails from './partials/comments_list.vue'

export default {
  name: 'SingleAudioArticle',
  components: {
    HeaderDetails,
    AudioPlayerDetails,
    BodyDetails,
    OptionDetails,
    // RelatedDetails,
    AddNewCommentForm,
    CommentListDetails
  },
  props: {
    articleContent: {
      default: null,
      type: Object
    }
  },
  data: function () {
    return {
      blogComments: this.articleContent.blog_articles[0].blog_article_comments
    }
  },
  methods: {
    numberOfTotalComments () {
      let numberOfComments = this.blogComments.length
      this.blogComments.forEach(function count (comment) {
        numberOfComments += comment.blog_article_comment_replies.length
      })
      return numberOfComments
    }
  }
}
</script>
