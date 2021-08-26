@extends('layouts.app')
@include('includes.navbar')

@section('content')

    <div class="container lv-container-articles">
        <h1>Pagina Lista de Articole Video</h1>

        <!-- LIST OF VIDEO ARTICLES, SECTION START -->
            <div class="lv-container-articles-list">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <video width="320" height="240" controls>
                                <source src="{{ url('videos/demo_video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Video Title
                                    <span>(15 min audio)</span>
                                </h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <video width="320" height="240" controls>
                                <source src="{{ url('videos/demo_video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Video Title
                                    <span>(15 min audio)</span>
                                </h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <video width="320" height="240" controls>
                                <source src="{{ url('videos/demo_video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Video Title
                                    <span>(15 min audio)</span>
                                </h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <video width="320" height="240" controls>
                                <source src="{{ url('videos/demo_video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Video Title
                                    <span>(15 min audio)</span>
                                </h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <video width="320" height="240" controls>
                                <source src="{{ url('videos/demo_video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">Video Title
                                    <span>(15 min audio)</span>
                                </h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, officia! Perferendis, numquam! Vitae, illum nihil, quasi esse ad quae rerum tempora cupiditate animi deserunt cum illo dolorem maiores! Quaerat expedita alias rerum dolor assumenda pariatur, autem consequatur fugit obcaecati amet praesentium eligendi dolorem! Eos, earum. Earum accusamus vero minus culpa, doloribus enim, doloremque mollitia numquam consectetur dolorum officia deleniti labore eligendi unde dignissimos laborum delectus quas, facere voluptatum iste dolor maiores. Quia laudantium fugiat odit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- LIST OF VIDEO ARTICLES, SECTION END -->
    </div>

@endsection