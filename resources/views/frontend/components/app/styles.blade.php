

    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/themify.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/slick-theme.css">

    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/animate.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/color11.css" media="screen"
        id="color">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend') }}/assets/css/main-style.css">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/frontend/assets/css/ar.css" />
    @endif

    {{-- noty --}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>