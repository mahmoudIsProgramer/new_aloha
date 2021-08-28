<!-- breadcrumb start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>Product Details </h2>
                        <ul>
                            <li><a href="{{ route('home') }}">{{ __('site.Home') }}</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            @if (isset($custome_title))
                                <li><a href="javascript:void(0)">{{ $custome_title }}</a></li>
                            @else
                                <li><a href="javascript:void(0)">{{ __('site.' . $page) }} </a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->
