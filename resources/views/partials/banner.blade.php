
@section('title_page')
{{ __('site.'.$pageName) }} 
@endsection


<!-- START => Breadcrumb -->
<div class="breadcrumb text-center" style="background-image: url({{asset('frontend/assets/imgs/bg/bg-breadcrumb.jpg')}});">
    <div class="container">
        <h2>{{ __('site.'.$pageName) }}</h2>
    </div>
</div>
<!-- //END => Breadcrumb -->



