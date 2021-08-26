@extends('layouts.app')
@include('includes.navbar')

@section('content')

    <div class="container lv-container-blog">
        <!-- MAIN CATEGORIES - WRITTEN ARTICLES, SECTION START -->
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">ARTICOLE</h5>
                </div>
                <a href="{{ url('/blog/articles/list') }}">
                    <img src="{{ url('../images/Card-img0.png') }}" class="d-block w-100" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                </div>
                <div class="card-body">
                    <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                </div>
            </div>
        <!-- MAIN CATEGORIES - WRITTEN ARTICLES, SECTION END -->

        <!-- MAIN CATEGORIES - AUDIO ARTICLES, SECTION START -->
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">AUDIO</h5>
                </div>
                <a href="{{ url('/blog/audios/list') }}">
                    <img src="{{ url('../images/Card-img1.png') }}" class="d-block w-100" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                </div>
                <div class="card-body">
                    <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                </div>
            </div>
        <!-- MAIN CATEGORIES - AUDIO ARTICLES, SECTION END -->
        
        <!-- MAIN CATEGORIES - VIDEO ARTICLES, SECTION START -->
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">VIDEO</h5>
                </div>
                <a href="{{ url('/blog/videos/list') }}">
                    <img src="{{ url('../images/Card-img2.png') }}" class="d-block w-100" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore iusto, magni quae, et laborum recusandae, cumque aperiam hic suscipit odio mollitia fugit aliquam velit nihil.</p>
                </div>
                <div class="card-body">
                    <a href="#">Subcategorie 1</a> <a href="#">Subcategorie 2</a> <a href="#">Subcategorie 3</a>
                </div>
            </div>
        <!-- MAIN CATEGORIES - VIDEO ARTICLES, SECTION END -->
    </div>

@endsection