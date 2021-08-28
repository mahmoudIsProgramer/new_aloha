<!DOCTYPE html>
<html>

<head>

    {{-- new  --}}
    <title> @yield('title_page') || {{$siteOption->seo_tit }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('des_seo'){{$siteOption->seo_des}}">
    <meta name="keywords" content="@yield('key_seo'){{$siteOption->seo_key}}">
    <meta name="author" content="{{$siteOption->seo_tit}}">

    {{-- start share button  --}}
    <meta property="og:image" content="@yield('image_url_share')" />
    <meta property="og:title" content="@yield('title_share')">
    <meta property="og:description" content="@yield('description_share')" />
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:type" content="website" />
    {{-- end share button  --}}

    <link rel="icon" href="{{$siteOption->icon_path}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{$siteOption->icon_path}}" type="image/x-icon">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">

    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/themify.css">
    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/slick-theme.css">
    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/animate.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/bootstrap.css">
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/color1.css" media="screen" id="color">

    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/assets/css/main.css">

 </head>

<!--<body class=" @if ( app()->getLocale() == 'ar') rtl @endif" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-body.jpg);">-->
<script src="https://ap-gateway.mastercard.com/checkout/version/56/checkout.js" data-error="errorCallback" data-cancel="cancelCallback" ></script>
        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }
            Checkout.configure({
              session: {
            	id: '{{ $session_id }}'
       			},
              interaction: {
                    merchant: {
                       name: ' {{paymet_name()}}',
                        address: {
                            line1: ' {{paymet_address()}} ',
                            line2: ''
                        }
                    }
               }
            });
        </script>
        <script src="https://ap-gateway.mastercard.com/checkout/version/56/checkout.js"
         data-cancel="cancelCallback"
         data-beforeRedirect="Checkout.saveFormFields"
         data-afterRedirect="Checkout.restoreFormFields">
</script>
<script src="https://ap-gateway.mastercard.com/checkout/version/56/checkout.js" data-error="https://aloha.com/en/customer/paymentFailed" data-cancel="https://aloha.com" data-complete="https://aloha.com/en/customer/paymentSuccess"></script>

<script type="text/javascript">
     Checkout.configure({
        session: {
            id: "{{ $session_id }}"
            },
        interaction: {
                merchant: {
                   name: ' {{paymet_name()}}',
                        address: {
                            line1: ' {{paymet_address()}} ',
                            line2: ''
                        }
                }
        }
    });
 </script>

<body class=" @if ( app()->getLocale() == 'ar') rtl @endif">

    <!-- loader start -->
    <div class="loader-wrapper">
        <div>
        <img src="{{url('/')}}/frontend/assets/imgs/loader.gif" alt="loader">
        </div>
    </div>
    <!-- loader end -->




    <!--<input type="button" value="pay with Meeza " class="btn-normal btn mb-2" onclick="callPaySky()" />-->

    <!-- <input type="button" value="pay with debit or credit card" class="btn-normal btn mb-2" onclick="Checkout.showPaymentPage();" />-->

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <form>
            <div class="text-right d-flex justify-content-center flex-wrap">



                            <input type="button" value="pay with Meeza " class="btn-normal btn mb-2" onclick="callPaySky()">




                            <input type="button" value="pay with debit or credit card" class="btn-normal btn mb-2" onclick="Checkout.showPaymentPage();">
                </div>

        </form>







    <!-- latest jquery-->
    <script src="{{url('/')}}/frontend/assets/js/jquery-3.3.1.min.js"></script>

    <!-- slick js-->
    <script src="{{url('/')}}/frontend/assets/js/slick.js"></script>

    <!-- popper js-->
    <script src="{{url('/')}}/frontend/assets/js/popper.min.js"></script>

    <!-- Timer js-->
    <script src="{{url('/')}}/frontend/assets/js/menu.js"></script>

    <!-- Bootstrap js-->
    <script src="{{url('/')}}/frontend/assets/js/bootstrap.js"></script>

    <!-- Bootstrap js-->
    <script src="{{url('/')}}/frontend/assets/js/bootstrap-notify.min.js"></script>

    <!-- Elevatezoom js-->
    <script src="{{url('/')}}/frontend/assets/js/jquery.elevatezoom.js"></script>

    <!-- Theme js-->
    <script src="{{url('/')}}/frontend/assets/js/slider-animat-three.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/script.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/modal.js"></script>




{{-- Meza Script --}}

<script src="https://upgstaglightbox.egyptianbanks.com/js/Lightbox.js" ></script>
<script type="text/javascript">

 function callPaySky() {

		var paymentMethodFromLightBox = null;
		var amount = '12';
        var mID = 10973286691;
        var tID = 12830017;
		var mRN = 1234;
		var trxdatetime= 20200531180732;
		var securehash = '40431ffed00fe9326e5f1b7062e4e1c7d338461f34decf0e79229fda83ef1ac6';
        var returnUrl='https://aloha.com/en/customer/paymentSuccess';

		Lightbox.Checkout.configure = {

			paymentMethodFromLightBox: paymentMethodFromLightBox,
			MID: mID,
			TID: tID,
			AmountTrxn: amount,
			MerchantReference: mRN,
			SecureHash: securehash,
			TrxDateTime: trxdatetime,
			ReturnUrl:returnUrl,

			completeCallback: function(data) {
				console.log('completed');

				console.log(data);
				document.location.href="https://aloha.com/en/customer/paymentSuccess";
			},
			errorCallback: function(error) {
				console.log(error);
			},
			cancelCallback: function() {
				 console.log('cancel');
			}
		};
		Lightbox.Checkout.showLightbox();
	}

</script>

</body>


</html>
