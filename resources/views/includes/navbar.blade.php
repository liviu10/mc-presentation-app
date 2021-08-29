<!-- NAVBAR, SECTION START -->
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('storage/images/Logo-img.png') }}" alt="">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> 
                    {{ Config::get('languages')[App::getLocale()]['display'] }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                        @foreach (Config::get('languages') as $lang => $language)
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> 
                                {{$language['display']}}
                            </a>
                        @endforeach
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR, SECTION END -->