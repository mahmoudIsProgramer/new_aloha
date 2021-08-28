<!-- My account bar start-->
<div id="myAccount" class="add_to_cart right account-bar">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my account</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <form action="{{ route('customer.login.post') }}" method="post" class="theme-form">
            @csrf
            @method('post')
            @include('partials._errors')
            <div class="form-group">
                <label for="email">{{ __('site.Email') }}</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email"
                    placeholder="{{ __('site.Email') }}" required="">
            </div>
            <div class="form-group">
                <label for="review">{{ __('site.Password') }}</label>
                <input type="password" name="password" class="form-control" id="review"
                    placeholder="{{ __('site.Password') }}" required="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-solid btn-md btn-block ">{{ __('site.Login') }}</button>
            </div>
            <div class="accout-fwd">
                <a href="javascript:void(0)" class="d-block">
                    <h5>@lang("site.Forgot Password")</h5>
                </a>
                <a href="go-register.html" class="d-block">
                    <h6>@lang("site.Don't Have Account?") <span>@lang('site.Register Now') </span></h6>
                </a>
            </div>
        </form>
    </div>
</div>
<!-- Add to account bar end-->
