@extends('layouts.app')
@include('includes.navbar')

@section('content')

    <!-- CAROUSEL, SECTION START -->
        <div id="carouselExampleCaptions" class="carousel slide lv-container-banner" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ( $displayCarouselImgUrls as $carouselImageUrl )
                    <button type="button" 
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : '' }}"
                            aria-current="{{ $loop->first ? 'true' : '' }}"
                            aria-label="{{ 'Slide ' . $loop->iteration }}">
                    </button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ( $displayCarouselImgUrls as $carouselImageUrl )
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/images/carousel/' . $carouselImageUrl) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                        <button type="button" class="btn btn-success">Află mai multe!</button>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- CAROUSEL, SECTION END -->

    <!-- HEADING, SECTION START -->
        <div class="container lv-container-heading">
            <div class="container-lead">
                <h1 class="display-4">Fluid jumbotron</h1>
                <p class="lead">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis dolorum blanditiis repellat porro est aliquid, esse magnam labore eaque maxime quae reiciendis vitae, harum fugiat adipisci ipsa placeat nostrum culpa quidem nulla doloribus nesciunt ipsam deleniti. Voluptates dicta praesentium quaerat?
                </p>
            </div>
            <div class="container-buttons">
                <button type="button" class="btn btn-primary">
                    <i class="far fa-clock"></i>
                    Programează-te!
                </button>
                @foreach ( $displaySocialMediaUrls as $key => $link )
                    <a href="{{ $link['url'] }}" class="btn btn-primary" target="_blank" title="Urmărește-mă pe {{ $link['name'] }}!">
                        <i class="{{ $link['class'] }}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    <!-- HEADING, SECTION END -->

    <!-- MAIN CATEGORIES, SECTION START -->
        <div class="container lv-container-categories">
            <!-- MAIN CATEGORIES - ARTICLES, SECTION START -->
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">ARTICOLE</h5>
                    </div>
                    <a href="{{ url('/blog/articles/list') }}">
                        <img src="{{ asset('storage/images/main-categories/' . $displayMainCategoriesImgUrls[0]) }}" class="d-block w-100" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                    </div>
                    <div class="card-body">
                        <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                    </div>
                </div>
            <!-- MAIN CATEGORIES - ARTICLES, SECTION END -->

            <!-- MAIN CATEGORIES - AUDIO, SECTION START -->
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">AUDIO</h5>
                    </div>
                    <a href="{{ url('/blog/audios/list') }}">
                        <img src="{{ asset('storage/images/main-categories/' . $displayMainCategoriesImgUrls[1]) }}" class="d-block w-100" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                    </div>
                    <div class="card-body">
                        <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                    </div>
                </div>
            <!-- MAIN CATEGORIES - AUDIO, SECTION END -->
            
            <!-- MAIN CATEGORIES - VIDEO, SECTION START -->
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">VIDEO</h5>
                    </div>
                    <a href="{{ url('/blog/videos/list') }}">
                        <img src="{{ asset('storage/images/main-categories/' . $displayMainCategoriesImgUrls[2]) }}" class="d-block w-100" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                    </div>
                    <div class="card-body">
                        <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                    </div>
                </div>
            <!-- MAIN CATEGORIES - VIDEO, SECTION END -->
        </div>
    <!-- MAIN CATEGORIES, SECTION END -->
    
    <!-- TESTIMONIALS, SECTION START -->
        <div id="carouselExampleIndicators" class="carousel slide lv-container-testimonials" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- TESTIMONIALS, SECTION END -->

    <!-- NEWSLETTER, SECTION START -->
        <div class="container lv-container-newsletter">
            <form action="/" method="POST">
                @csrf
                <div class="row">
                    <div class="col col-5">
                        <input type="text" class="form-control" placeholder="Numele si Prenumele tau" name="full_name" required>
                    </div>
                    <div class="col col-5">
                        <input type="email" class="form-control" placeholder="Adresa ta de e-mail" name="email" required>
                    </div>
                    <div class="col col-2">
                        <button type="submit" class="btn btn-success">ABONEAZA-TE!</button>
                    </div>
                </div>
                <div class="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="privacy_policy">
                        <label class="form-check-label lead" for="flexCheckChecked">
                            Sunt de acord cu 
                            <a href="#">termenii si conditiile</a>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    <!-- NEWSLETTER, SECTION END -->

@endsection