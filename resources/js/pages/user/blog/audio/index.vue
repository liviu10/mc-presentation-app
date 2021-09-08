<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="container lv-con-sect-audio">
        <h1>APP AUDIO ARTICLES PAGE</h1>
        <!-- LIST OF AUDIO ARTICLES, SECTION START -->
        <div class="lv-con-sect-audio-list">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Article Title
                <span>(15 min audio)</span>
              </h5>
              <p class="card-text">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.
              </p>
              <!-- AUDIO PLAYER, SECTION START -->
              <audio controls>
                <source src="audio/demo_file.mp3" type="audio/mpeg3">
              </audio>
              <!-- AUDIO PLAYER, SECTION END -->
            </div>
          </div>
        </div>
        <!-- LIST OF AUDIO ARTICLES, SECTION END -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AudioArticlesPage'
}
</script>
