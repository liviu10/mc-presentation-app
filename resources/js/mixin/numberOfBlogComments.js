export default {
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
