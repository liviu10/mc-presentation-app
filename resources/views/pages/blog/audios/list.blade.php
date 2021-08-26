@extends('layouts.app')
@include('includes.navbar')

@section('content')

    <div class="container lv-container-articles">
        <h1>Pagina Lista de Articole Audio</h1>

        <!-- LIST OF AUDIO ARTICLES, SECTION START -->
            <div class="lv-container-articles-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Article Title 
                            <span>(15 min audio)</span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.</p>
                        <audio controls>
                            <source src="{{ url('audios/demo_audio.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Article Title 
                            <span>(15 min audio)</span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.</p>
                        <audio controls>
                            <source src="{{ url('audios/demo_audio.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Article Title 
                            <span>(15 min audio)</span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.</p>
                        <audio controls>
                            <source src="{{ url('audios/demo_audio.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Article Title 
                            <span>(15 min audio)</span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.</p>
                        <audio controls>
                            <source src="{{ url('audios/demo_audio.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Article Title 
                            <span>(15 min audio)</span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus harum libero tenetur quaerat? Nam incidunt eligendi quibusdam ut earum? Asperiores, cum? Possimus aspernatur eum inventore, esse commodi facilis. Ex veritatis itaque fuga nostrum eligendi, asperiores unde, corporis animi nihil iure nisi ea, at beatae voluptatem in architecto! Libero quod hic voluptates, at omnis repellendus, necessitatibus blanditiis numquam nulla esse molestias dolorum sed nobis qui, illo ullam dolore. Quaerat aliquam non soluta eum voluptatum corporis dolor.</p>
                        <audio controls>
                            <source src="{{ url('audios/demo_audio.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
            </div>
        <!-- LIST OF AUDIO ARTICLES, SECTION END -->
    </div>

@endsection