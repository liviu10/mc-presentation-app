<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <!-- CAROUSEL, SECTION START -->
      <div id="carouselExampleCaptions" class="carousel slide lv-container-banner" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" />
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" />
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" />
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4" />
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5" />
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/images/carousel/Carousel-img0.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/images/carousel/Carousel-img1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/images/carousel/Carousel-img2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/images/carousel/Carousel-img3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Forth slide label</h5>
              <p>Some representative placeholder content for the forth slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/images/carousel/Carousel-img4.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Fifth slide label</h5>
              <p>Some representative placeholder content for the fifth slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true" />
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" />
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- CAROUSEL, SECTION END -->

      <!-- HEADING, SECTION START -->
      <div class="container lv-container-heading">
        <div class="container-lead">
          <h1 class="display-4">
            Fluid jumbotron
          </h1>
          <p class="lead">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis dolorum blanditiis repellat porro est aliquid, esse magnam labore eaque maxime quae reiciendis vitae, harum fugiat adipisci ipsa placeat nostrum culpa quidem nulla doloribus nesciunt ipsam deleniti. Voluptates dicta praesentium quaerat?
          </p>
        </div>
        <div class="container-buttons">
          <div class="container-buttons-appointment">
            <button type="button" class="btn btn-primary btn-lg">
              <i class="far fa-clock" />
              Programează-te!
            </button>
          </div>
          <div class="container-buttons-social-media">
            <a href="https://www.facebook.com/groups/269560668238590/?ref=share" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Facebook!">
              <fa :icon="['fab', 'facebook']" fixed-width />
            </a>
            <a href="" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Instagram!">
              <fa :icon="['fab', 'instagram']" fixed-width />
            </a>
            <a href="" class="btn btn-primary btn-lg" target="_blank" title="Urmărește-mă pe Youtube!">
              <fa :icon="['fab', 'youtube']" fixed-width />
            </a>
          </div>
        </div>
      </div>
      <!-- HEADING, SECTION END -->

      <!-- MAIN CATEGORIES, SECTION START -->
      <div class="container lv-container-categories">
        <!-- MAIN CATEGORIES - ARTICLES, SECTION START -->
        <div class="card" style="width: 20rem;">
          <div class="card-body">
            <h5 class="card-title">
              ARTICOLE
            </h5>
          </div>
          <router-link :to="{ name: 'article.index' }">
            <img src="/images/cards/Card-img0.png" class="d-block w-100" alt="...">
          </router-link>
          <div class="card-body">
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.
            </p>
          </div>
          <div class="card-body">
            <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
          </div>
        </div>
        <!-- MAIN CATEGORIES - ARTICLES, SECTION END -->

        <!-- MAIN CATEGORIES - AUDIO, SECTION START -->
        <div class="card" style="width: 20rem;">
          <div class="card-body">
            <h5 class="card-title">
              AUDIO
            </h5>
          </div>
          <router-link :to="{ name: 'audio.index' }">
            <img src="/images/cards/Card-img1.png" class="d-block w-100" alt="...">
          </router-link>
          <div class="card-body">
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.
            </p>
          </div>
          <div class="card-body">
            <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
          </div>
        </div>
        <!-- MAIN CATEGORIES - AUDIO, SECTION END -->

        <!-- MAIN CATEGORIES - VIDEO, SECTION START -->
        <div class="card" style="width: 20rem;">
          <div class="card-body">
            <h5 class="card-title">
              VIDEO
            </h5>
          </div>
          <router-link :to="{ name: 'video.index' }">
            <img src="/images/cards/Card-img2.png" class="d-block w-100" alt="...">
          </router-link>
          <div class="card-body">
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.
            </p>
          </div>
          <div class="card-body">
            <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
          </div>
        </div>
        <!-- MAIN CATEGORIES - VIDEO, SECTION END -->
      </div>
      <!-- MAIN CATEGORIES, SECTION END -->

      <!-- TESTIMONIALS, SECTION START -->
      <div id="carouselExampleCaptions1" class="carousel slide lv-container-testimonials" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" />
          <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="1" aria-label="Slide 2" />
          <button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="2" aria-label="Slide 3" />
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h3>Nume: Voica Liviu</h3>
            <p>Ocupatie: Developer</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.</p>
          </div>
          <div class="carousel-item">
            <h3>Nume: Popescu George</h3>
            <p>Ocupatie: Logistic Planner</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.</p>
          </div>
          <div class="carousel-item">
            <h3>Nume: Andreea Ionescu</h3>
            <p>Ocupatie: Marketing Director</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, autem. Repellendus rerum deleniti dolores sed aperiam tempora reprehenderit iste dolorem? In, ut veniam modi ab unde optio illo nostrum at molestiae vel porro, voluptatibus accusamus dolorem hic inventore neque quae eveniet libero error. Temporibus, natus laborum facilis, eum dolor id ipsa dignissimos et, sunt quo autem. Voluptatum modi magni iusto optio eaque atque dolore dignissimos accusamus, eligendi ipsum fugiat cupiditate repudiandae nihil. Vel, tenetur aliquid.</p>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true" />
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" />
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- TESTIMONIALS, SECTION END -->

      <!-- NEWSLETTER, SECTION START -->
      <div class="container lv-container-newsletter">
        <form action="/" method="POST">
          <div class="row">
            <div class="col col-5">
              <input type="text" class="form-control" placeholder="Numele si Prenumele tau" name="full_name" required>
            </div>
            <div class="col col-5">
              <input type="email" class="form-control" placeholder="Adresa ta de e-mail" name="email" required>
            </div>
            <div class="col col-2">
              <button type="submit" class="btn btn-success">
                ABONEAZA-TE!
              </button>
            </div>
          </div>
          <div class="row">
            <div class="form-check">
              <input id="flexCheckChecked" class="form-check-input" type="checkbox" value="" name="privacy_policy">
              <label class="form-check-label lead" for="flexCheckChecked">
                Sunt de acord cu
                <a href="#">termenii si conditiile</a>
              </label>
            </div>
          </div>
        </form>
      </div>
      <!-- NEWSLETTER, SECTION END -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePage'
}
</script>
