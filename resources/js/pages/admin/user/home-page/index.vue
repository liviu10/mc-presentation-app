<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin">
        <div class="lv-pg-admin-header">
          <h1>USER HOME PAGE & SECTIONS</h1>
        </div>
        <div class="lv-pg-admin-body">
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">
                Carousel
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-user-home-page-section-carousel' }" class="btn btn-primary">
                See more
              </router-link>
            </div>
          </div>
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">
                Description
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-user-home-page-section-jumbotron' }" class="btn btn-primary">
                See more
              </router-link>
            </div>
          </div>
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">
                Testimonials
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-user-home-page-section-testimonials' }" class="btn btn-primary">
                See more
              </router-link>
            </div>
          </div>
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">
                Newsletter
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-user-home-page-section-newsletter' }" class="btn btn-primary">
                See more
              </router-link>
            </div>
          </div>
          <div class="card my-5">
            <div class="card-body">
              <h5 class="card-title">
                Footer
              </h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p>
              <router-link :to="{ name: 'admin-user-home-page-section-footer' }" class="btn btn-primary">
                See more
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminUserHomePageAndSections',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - User Home Page & Sections' }
  }
}
</script>
