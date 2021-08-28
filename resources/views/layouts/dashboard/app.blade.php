<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> E-bakers | @yield('title_page')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {{--
    <!-- Bootstrap 3.3.7 -->--}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dashboard/js/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

  {{-- fancybox --}}
  <link rel="stylesheet" href="{{url('/')}}/dashboard/libs/popup/jquery.fancybox.min.css">

  @if (app()->getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">


  <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/tarek.css') }}">
  <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Cairo', sans-serif !important;
    }
  </style>
  @else
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE.min.css') }}">
  @endif
  <style>
    .mr-2 {
      margin-right: 5px;
    }
  </style>
  {{--
    <!-- jQuery 3 -->--}}
  <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
  {{--noty--}}
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
  <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>
  {{--
    <!-- iCheck -->--}}
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">
  {{-- tark css  --}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/tarek.css') }}">

  {{--html in ie--}}
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


  <!-- multY select box  -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

  {{-- tagsinput css  --}}
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">



  @stack('css')

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{url('/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Eb </b>Ad</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ebakers</b>Admin</span>
      </a>

      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">




            {{--<!-- Tasks: style can be found in dropdown.less -->--}}
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
              <ul class="dropdown-menu">
                <li>
                  {{--<!-- inner menu: contains the actual data -->--}}
                  <ul class="menu">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                    $properties)
                    <li>
                      <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </li>
              </ul>
            </li>

            {{--<!-- User Account: style can be found in dropdown.less -->--}}
            <li class="dropdown user user-menu">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ auth()->user()->image_path }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ auth()->user()->first_name }}
                  {{ auth()->user()->last_name }}</span>
              </a>
              <ul class="dropdown-menu">

                {{--<!-- User image -->--}}
                <li class="user-header">
                  <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">

                  <p>
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    <small>Member since {{ auth()->user()->created_at }}</small>
                  </p>
                </li>

                {{--<!-- Menu Footer-->--}}
                <li class="user-footer">
                  <div class="pull-left">

                    @if (auth()->user()->hasPermission('update_users'))
                    <a href="{{ route('dashboard.users.edit',auth()->user()->id) }}"
                      class="btn btn-warning btn-flat">
                      @lang('site.profile')
                    </a>


                    @endif



                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                      class="btn btn-danger btn-flat">
                      @lang('site.log_out')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

    </header>

    @include('layouts.dashboard._aside')

    @yield('content')

    @include('partials._session')
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Developed by </b> <a href="http://e-bakers.org" target="_blank">Ebakers</a>
      </div>
      <strong>Copyright &copy;
        <?=date("Y");?>
        <a href="http://e-bakers.org" target="_blank">Ebakers</a>.</strong> All rights
      reserved.
    </footer>
  </div><!-- end of wrapper -->

  @yield('scripts')


  {{--
    <!-- jQuery 3 -->--}}
  <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>



  {{--
<!-- Bootstrap 3.3.7 -->--}}
  <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
  {{--icheck--}}
  <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>

  <!-- start multople select  -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <!-- end multople select  -->

  {{-- fancybox --}}
  <script src="{{url('/')}}/dashboard/libs/popup/jquery.fancybox.min.js"></script>


  <!-- DataTables -->
  <script src="{{ asset('dashboard/js/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('dashboard/js/datatables.net-bs//js/dataTables.bootstrap.min.js') }}"></script>

  {{--
    -- FastClick -->--}}
  <script src="{{ asset('dashboard/js/fastclick.js') }}"></script>
  {{--
    !-- AdminLTE App -->--}}
  <script src="{{ asset('dashboard/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('dashboard/js/tarek.js') }}"></script>
  <!-- page script -->

  {{-- tagsinput js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>





  <script>
    $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
  </script>



  <script>
    $(document).ready(function () {

            ////////////
            $('.sidebar-menu').tree();
            //icheck
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //delete
            $('.delete').click(function (e) {
                var that = $(this)
                e.preventDefault();
                var n = new Noty({
                    text: "@lang('site.confirm_delete')",
                    type: "warning",
                    killer: true,

                    buttons: [
                        Noty.button("  &nbsp;&nbsp;&nbsp;  @lang('site.yes')",
                            'btn btn-danger mr-2 fa fa-trash ui-button',
                            function () {

                                that.closest('form').submit();

                            }),
                        Noty.button(" &nbsp;&nbsp;&nbsp;  @lang('site.no')   ",
                            'btn btn-primary mr-2 fa fa-close',
                            function () {
                                n.close();
                            })
                    ]
                });
                n.show();
            }); //end of delete

            // image preview
            $(".image").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(".imageTwo").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-previewtwo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image2").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image3").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(".image4").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview4').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        })
  </script>

  <script>
    // $(function() {
        //     // attr() method applied here
        //     $(".ui-button").prop('disabled', true);
        // });

        $(".ui-button").click(function(){
            alert('hi');
            $(this).prop('disabled', true);
        });

  </script>

  <script>
    // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
  </script>
  @stack('js')
  @yield('js_codes')

</body>

</html>
