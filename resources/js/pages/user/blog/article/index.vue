<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-articles">
        <div class="lv-con-pg-articles-title">
          <h1>APP WRITTEN ARTICLES PAGE</h1>
        </div>
        <!-- LIST OF WRITTEN ARTICLES, SECTION START -->
        <div class="lv-con-pg-articles-list">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Article Title
                <span>(15 min read)</span>
                <p>
                  Published on:
                  <span>Septembrie 11 2021</span>
                </p>
              </h5>
              <p class="card-text">
                <fa icon="quote-left" fixed-width />
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.
              </p>
              <router-link :to="{ name: 'view.index' }" class="btn btn-primary">
                <fa icon="book-reader" fixed-width />
                Citeste mai mult!
              </router-link>
            </div>
          </div>
        </div>
        <div class="lv-con-pg-articles-list">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Article Title
                <span>(15 min read)</span>
                <p>
                  Published on:
                  <span>Septembrie 11 2021</span>
                </p>
              </h5>
              <p class="card-text">
                <fa icon="quote-left" fixed-width />
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.
              </p>
              <router-link :to="{ name: 'article.index' }" class="btn btn-primary">
                <fa icon="book-reader" fixed-width />
                Citeste mai mult!
              </router-link>
            </div>
          </div>
        </div>
        <div class="lv-con-pg-articles-list">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Article Title
                <span>(15 min read)</span>
                <p>
                  Published on:
                  <span>Septembrie 11 2021</span>
                </p>
              </h5>
              <p class="card-text">
                <fa icon="quote-left" fixed-width />
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.
              </p>
              <router-link :to="{ name: 'article.index' }" class="btn btn-primary">
                <fa icon="book-reader" fixed-width />
                Citeste mai mult!
              </router-link>
            </div>
          </div>
        </div>
        <!-- LIST OF WRITTEN ARTICLES, SECTION END -->
        <!-- MORE WRITTEN ARTICLES, SECTION START -->
        <div class="lv-con-pg-articles-button-more">
          <button type="button"
                  class="btn btn-primary btn-lg"
                  @click="showMore"
          >
            <i class="far fa-clock" />
            Mai multe articole!
          </button>
        </div>
        <!-- MORE WRITTEN ARTICLES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WrittenArticlesPage',
  components: {},
  props: {},
  data: function () {
    return {}
  },
  computed: {},
  mounted () {},
  methods: {
    showMore () {
      this.$router.push({ path: '/blog/article' })
    }
  }
}
</script>
