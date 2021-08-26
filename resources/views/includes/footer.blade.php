<!-- FOOTER, SECTION START -->
<footer>
        <div class="container-fluid container-footer">
            <div class="container-footer-menu">
                <div class="container-footer-menu-button">
                    <p>
                        <a href="#">
                            TERMENI SI CONDITII
                        </a>
                    </p>
                </div>
                <div class="container-footer-menu-contact">
                    <p>
                        <i class="fas fa-at"></i>
                        <a href="mailto: {{ $displaySiteOwner->pluck('email')[0] }}">
                            {{ $displaySiteOwner->pluck('email')[0] }}
                        </a>
                    </p>
                    <p>
                        <span>Mă găsești și pe:</span>
                        @foreach ( $displaySocialMediaUrls as $key => $link )
                            <a href="{{ $link['url'] }}" class="btn btn-primary" target="_blank" title="Urmărește-mă pe {{ $link['name'] }}!">
                                <i class="{{ $link['class'] }}"></i>
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="container-footer-copyright">
                <p>
                    Copyright &#169; {{ date('Y') }}
                    <a href="{{ $displayWebsiteUrl }}">{{ $displaySiteOwner->pluck('name')[0] }}</a>
                </p>
            </div>
        </div>
    </footer>
<!-- FOOTER, SECTION END -->