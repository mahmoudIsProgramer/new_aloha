<!DOCTYPE html>
<html lang="zxx">

<head>

    {{-- meta --}}
    @include('frontend.components.app.meta')

    {{-- fonts --}}
    @include('frontend.components.app.fonts')

    {{-- styles --}}
    @include('frontend.components.app.styles')

    @stack('js')

</head>

<body class="bg-light">

    <!-- Preloader -->
    {{-- <div class="preloaders loader-wrapper">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}

    <div class="top-head-offer">
        <p class="mb-0">
            50% OFF On All Products <a href="">Shop Our Products Now</a>
        </p>
    </div>

    {{-- styles --}}
    @include('frontend.components.app.header')

    @include('partials._session')

    {{-- content --}}
    @yield('content')

    {{-- styles --}}
    @include('frontend.components.app.footer')

    {{-- alert adds --}}
    @include('frontend.components.app.alert_ads')

    {{-- scripts --}}
    @include('frontend.components.app.scripts')

    {{-- cart --}}
    @include('frontend.components.app.cart')

    {{-- wishlist --}}
    @include('frontend.components.app.wishlist')


    {{-- settings --}}
    @include('frontend.components.app.settings')

    {{-- account --}}
    @include('frontend.components.app.account')

    {{-- scripts --}}
    @include('frontend.components.app.scripts')

</body>

</html>
