<title>@yield('title_page') || {{ $siteOption->seo_tit }} </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="@yield('des_seo'){{ $siteOption->seo_des }}">
<meta name="keywords" content="@yield('key_seo'){{ $siteOption->seo_key }}">
<meta name="author" content="{{ $siteOption->seo_tit }}">
<link rel="icon" href="{{ $siteOption->icon_path }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ $siteOption->icon_path }}" type="image/x-icon">
<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- start share button --}}
<meta property="og:image" content="@yield('image_url_share')" />
<meta property="og:title" content="@yield('title_share')">
<meta property="og:description" content="@yield('description_share')" />
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website" />
{{-- end share button --}}
