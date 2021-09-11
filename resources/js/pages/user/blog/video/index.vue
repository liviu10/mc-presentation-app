<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-pg-video">
        <div class="lv-con-pg-video-title">
          <h1>APP VIDEO ARTICLES PAGE</h1>
        </div>
        <!-- LIST OF VIDEO ARTICLES, SECTION START -->
        <div class="lv-con-pg-video-list">
          <div class="card">
            <div class="row g-0">
              <div class="col-md-4">
                <video controls>
                  <source src="videos/demo_video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">
                    Video Title
                    <span>(15 min audio)</span>
                    <p>
                      Published on:
                      <span>Septembrie 11 2021</span>
                    </p>
                  </h5>
                  <p class="card-text">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="lv-con-pg-video-list">
          <div class="card">
            <div class="row g-0">
              <div class="col-md-4">
                <video controls>
                  <source src="videos/demo_video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">
                    Video Title
                    <span>(15 min audio)</span>
                    <p>
                      Published on:
                      <span>Septembrie 11 2021</span>
                    </p>
                  </h5>
                  <p class="card-text">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="lv-con-pg-video-list">
          <div class="card">
            <div class="row g-0">
              <div class="col-md-4">
                <video controls>
                  <source src="videos/demo_video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">
                    Video Title
                    <span>(15 min audio)</span>
                    <p>
                      Published on:
                      <span>Septembrie 11 2021</span>
                    </p>
                  </h5>
                  <p class="card-text">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- LIST OF VIDEO ARTICLES, SECTION END -->
        <!-- MORE VIDEO ARTICLES, SECTION START -->
        <div class="lv-con-pg-articles-button-more">
          <button type="button"
                  class="btn btn-primary btn-lg"
                  @click="showMore"
          >
            <i class="far fa-clock" />
            Mai multe articole video!
          </button>
        </div>
        <!-- MORE VIDEO ARTICLES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'VideoArticlesPage'
}
</script>
