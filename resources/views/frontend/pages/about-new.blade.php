@if(session('locale') == 'en')
    @include("frontend.pages.about-en")
@else
    @include("frontend.pages.about-ar")
@endif
