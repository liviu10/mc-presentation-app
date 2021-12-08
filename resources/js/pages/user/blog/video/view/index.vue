<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-video">
        <h1>APP DISPLAY VIDEO ARTICLE PAGE</h1>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import rate from 'vue-rate'
import 'vue-rate/dist/vue-rate.css'
import Form from 'vform'

Vue.use(rate)

export default {
  name: 'VideoArticlesPage',
  components: {},
  layout: '',
  middlewa: '',
  props: {
    length: {
      type: Number,
      default: null
    },
    value: {
      type: Number,
      default: null
    },
    showcount: {
      type: Boolean,
      default: null
    },
    ratedesc: {
      type: String,
      default: null
    }
  },
  data: function () {
    return {
      myRate: 0,
      countLikes: 0,
      countDislikes: 0,
      message_success: this.$t('user.article_blog_page.comment_form.success_message'),
      form: new Form({
        full_name: '',
        email: '',
        message: '',
        privacy_policy: false
      })
    }
  },
  computed: {
    // mapped getters
  },
  mounted () {},
  methods: {
    onAfterRate () {
      console.log('Test')
    },
    articleLike () {
      this.countLikes += 1
    },
    articleDislikes () {
      this.countDislikes += 1
    },
    async commentArticle () {
      const videoArticleApi = '/blog/article-comments'
      const { data } = await this.form.post(videoArticleApi)
      console.log('>>>>> Comment on video articles <<<<<<')
    }
  },
  metaInfo () {
    return { title: this.$t('user.blog_system_pages.video_article_blog_pages.article_blog_page.page_title') }
  }
}
</script>
