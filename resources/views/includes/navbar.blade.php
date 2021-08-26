<!-- NAVBAR, SECTION START -->
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('../images/Logo-img.png') }}" alt="">
            <p class="text-wrap">Lorem ipsum dolor sit amet.</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @for ( $key = 0; $key < count($getNavigationBarUrls); $key++ )
                <li class="nav-item">
                    @if ( $getNavigationBarUrls[0]['folder_path'] === '/' )
                    <a class="nav-link active" aria-current="page" 
                        href="{{ url($getNavigationBarUrls[$key]['folder_path']) }}">
                        {{ $getNavigationBarUrls[$key]['folder_name'] }}
                    </a>
                    @else
                    <a class="nav-link" aria-current="page" 
                        href="{{ url($getNavigationBarUrls[$key]['folder_path']) }}">
                        {{ $getNavigationBarUrls[$key]['folder_name'] }}
                    </a>
                    @endif
                </li>
                @endfor
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR, SECTION END -->