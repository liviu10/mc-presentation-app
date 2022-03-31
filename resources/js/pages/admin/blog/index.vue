<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>ADMIN BLOG</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="my-4">
            <ul id="myTab" class="nav nav-tabs">
              <li class="nav-item">
                <a href="#blog_categories_and_subcategories" class="nav-link active" data-bs-toggle="tab">Blog Categories & Subcategories</a>
              </li>
              <li class="nav-item">
                <a href="#blog_articles_and_comments" class="nav-link" data-bs-toggle="tab">Blog Articles & Comments</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="blog_categories_and_subcategories" class="tab-pane fade show active">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      BLOG CATEGORIES & SUBCATEGORIES
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-blog-categories-and-subcategories-page' }" class="btn btn-primary">
                      View
                    </router-link>
                  </div>
                </div>
              </div>
              <div id="blog_articles_and_comments" class="tab-pane fade">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      BLOG ARTICLES & COMMENTS
                    </h5>
                    <p class="card-text">
                      Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <router-link :to="{ name: 'admin-blog-articles-and-comments-page' }" class="btn btn-primary">
                      View
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminBlog',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - Blog' }
  }
}
</script>
