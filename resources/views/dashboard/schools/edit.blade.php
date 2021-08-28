@extends('layouts.dashboard.app')
<?php
$page="schools";
$title=trans('site.schools');
?>
@section('title_page')
{{$title}}
@endsection


@push('js')
    <!-- start get states and regoins and streests  -->
    <script type="text/javascript">

        $(document).ready(function () {

            @if( old('category_id') )

                @php
                    $category_id = old('category_id');
                    $subcategories_ids = old('subcategories_ids');
                @endphp

                $.ajax({
                    url:'{!! route("dashboard.schools.create") !!}',
                    type:'get',
                    dataType:'html',
                    data:{ category_id:{{ $category_id }},getData:'subcategories' , select:''  },
                    success: function (data) {
                        $('.subcategories').html(data)
                    }
                });

            @endif

            @if(old('state_id'))

                @php
                    $city_id = old('city_id');
                    $state_id = old('state_id');
                @endphp
                $.ajax({
                    url:'{!! route("dashboard.schools.create") !!}',
                    type:'get',
                    dataType:'html',
                    data:{ city_id:{{ $city_id }},getData:'states' , select:{{ $state_id }}  },
                    success: function (data) {
                        $('.states').html(data)
                    }
                });

            @endif

            // change city
            $(document).on('change','.city_id',function () {

                var city_id = $('.city_id option:selected').val();
                var token = $("input[name='_token']").val();
                $('.states').html('') ;
                if ( city_id > 0 ){
                    $.ajax({

                        url:"{!! route('dashboard.schools.create') !!}",
                        type:'get',
                        dataType:'',
                        data:{ city_id:city_id,getData:'states',select:''  },
                        success: function (data) {
                            $('.states').html(data) ;
                        }
                    });
                }
            });


        });


        // start  get subcategories
        $(document).ready(function () {
            $(document).on('change','.category_id',function () {
                var category_id = $('.category_id option:selected').val();
                var token = $("input[name='_token']").val();

                $('.subcategories').html('') ;
                if ( category_id > 0 ){
                    $.ajax({

                        url:"{!! route('dashboard.schools.create') !!}",
                        type:'get',
                        dataType:'',
                        data:{ category_id:category_id,getData:'subcategories',select:''  },
                        success: function (data) {
                            $('.subcategories').html(data) ;
                        }

                    });
                }
            });
        });


    </script>
    <!-- en  get states and regoins and streests  -->


    <script>

        <?php
            $lat = old('lat') ?? $schools->lat ;
            $lng = old('lng') ?? $schools->lng ;
        ?>

        function GetAddress() {
            var lat = parseFloat(document.getElementById("lat").value);
            var lng = parseFloat(document.getElementById("lng").value);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        $('#address').val(results[1].formatted_address) ;
                    }
                }
            });
        }

        // Initialize the map.
        function initMap() {
            GetAddress();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {
                    lat: {!! $lat  !!},
                    lng: {!! $lng !!}
                }
            });
            var markerOne = new google.maps.Marker({
                position: {
                    lat: {!! $lat  !!},
                    lng: {!! $lng !!}
                },
                map: map,
                draggable: true
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('address'));

            google.maps.event.addListener(searchBox, 'places_changed', function () {
                var places = searchBox.getPlaces();
                var boundsOne = new google.maps.LatLngBounds();
                var i, place;

                for (i = 0; place = places[i]; i++) {
                    boundsOne.extend(place.geometry.location);
                    markerOne.setPosition(place.geometry.location);
                }
                map.fitBounds(boundsOne);
                map.setZoom(15);
            });

            google.maps.event.addListener(markerOne, 'position_changed', function () {

                var lat = markerOne.getPosition().lat();
                var lng = markerOne.getPosition().lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
                GetAddress();
            });
        }

    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfZ9uoqq6GuMOzgn-P-NA4gImzSpLXkoc&callback&callback=initMap&libraries=places">
    </script>

    <script type="text/javascript" src="{!! asset('dashboard/js/locationpicker.jquery.js') !!}"></script>
@endpush

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.schools')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.schools.index') }}"> @lang('site.schools')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            <div class="box-body">
                @include('partials._errors')

                <form action="{{ route('dashboard.schools.update', $schools->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="col-md-12">
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach ( LaravelLocalization::getSupportedLocales() as $locale =>  $properties)
                                        <li role="presentation" class="@if( $loop->first ) active  @endif"><a href="#{{$locale}}" aria-controls="home" role="tab" data-toggle="tab"> {{ $properties['native'] }} </a></li>
                                    @endforeach
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $locale =>  $properties)
                                        <div role="tabpanel" class="tab-pane @if( $loop->first) active  @endif" id="{{$locale}}" >

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.name')</label>
                                                <input   type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name')??$schools->translate($locale)->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.address')</label>
                                                <input   type="text" name="{{ $locale }}[address]" class="form-control" value="{{ old($locale . '.address')??$schools->translate($locale)->address }}">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.description')</label>
                                                <textarea  name="{{ $locale }}[description]"  class="form-control" cols="30" rows="5">{{ old($locale . '.description')??$schools->translate($locale)->description }}</textarea>
                                            </div>
                                            <div class="  with-border"></div><br>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input  type="file" id='image' name="image"
                                        class="form-control image2" enctype="multipart/form-data">
                                </div>

                                <div class="form-group">
                                    <img src="{{ $schools->image_path }}" style="width: 100px"
                                        class="img-thumbnail image-preview2" alt="">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.images')</label>
                                    <input  type="file"  name="images[]"
                                        multiple class="form-control" enctype="multipart/form-data">
                                        @foreach ( $images as $imgs )
                                            <a href="{{url('dashboard/schools/deleteImage').'/'.$imgs['id']}}"
                                                onclick="return confirm('{{trans('site.confirm_delete')}}')"
                                                class="confirm btn btn-danger img-thumbnail image-preview" style="width: 100px;
                                                " title="Delete this item">
                                                <i class="fa fa-trash"></i><br>
                                                <img src="{{$imgs->image_path}}" class="img-thumbnail image-preview" alt="">
                                            </a>
                                        @endforeach
                                </div>




                                <!-- <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control"   required >
                                        <option value="1" @if(old('status') == '1'|| $schools->status== '1') selected @endif>@lang('site.Active')</option>
                                        <option value="2" @if(old('status') == '2'|| $schools->status== '2') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div> -->

                            </div>
                            <div class="col-md-6">

                                    @php
                                        $college = ['cambridge','edexcel','oxford'] ;
                                        $colleges   = explode(',',$schools->college);
                                        \Log::info($colleges);
                                    @endphp

                                    <label>@lang('site.college')</label>

                                    <div class="form-group">
                                        <select name="college[]" class="form-control selectpicker" multiple data-live-search="true" required >
                                            <option value=""> @lang('site.college')  </option>
                                            @foreach( $college as $value )
                                                <option value="{{ $value }}" {{ (in_array($value,$colleges)) ? "selected" :'' }}> {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input required="required"  type="email" name="email" class="form-control" value="{{old('email')??$schools->email}}"  >
                                </div>


                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input required="required"  type="phone" name="phone" class="form-control"  value="{{old('phone')??$schools->phone}}"    >
                                </div>

                                <!-- <div class="form-group">
                                    <label>@lang('site.password')</label>
                                    <input required="required"  type="password" name="password" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.password_confirmation')</label>
                                    <input required="required"  type="password" name="password_confirmation" class="form-control" >
                                </div> -->

                                <!-- cities -->
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1"> @lang('site.city') </label>
                                    <select   class="form-control select2 city_id" style="width: 100%;" name="city_id"  required  >
                                        <option value="">@lang('site.city')</option>
                                        @foreach( $cities as $key => $value)
                                                <option  value="{{$value->id}}" {!!  (  $schools->city_id == $value->id  && empty(old("city_id"))  ) ? 'selected' : '' !!} {!!  ( old("city_id") == $value->id  ) ? 'selected' : '' !!}> {{$value->translate(App::getLocale())->name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->

                                <!-- cities -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> @lang('site.city') </label>
                                    <select   class="form-control select2 city_id" style="width: 100%;" name="city_id"  required  >
                                        <option value="">@lang('site.city')</option>
                                        @foreach( $cities as $key => $value)
                                                <option  value="{{$value->id}}" {!!  (  $schools->city_id == $value->id  && empty(old("city_id"))  ) ? 'selected' : '' !!} {!!  ( old("city_id") == $value->id  ) ? 'selected' : '' !!}> {{$value->translate(App::getLocale())->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- states  -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">  @lang('site.states')  </label>
                                    <span class="states">
                                        <select class="form-control select2 state_id" style="width: 100%;" name="state_id" required   >
                                            <option>@lang('site.states')</option>
                                            @foreach( $states as $key => $value )
                                                    <option  value="{{$value->id}}" {!! ( old("state_id") == $value->id  || $schools->state_id == $value->id  ) ? 'selected' : '' !!} > {{$value->translate(App::getLocale())->name}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>

                                <!-- states  -->
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">  @lang('site.states')  </label>
                                    <span class="states">
                                        <select class="form-control select2 state_id" style="width: 100%;" name="state_id" required   >
                                            <option>@lang('site.states')</option>
                                            @foreach( $states as $key => $value )
                                                    <option  value="{{$value->id}}" {!! ( old("state_id") == $value->id  || $schools->state_id == $value->id  ) ? 'selected' : '' !!} > {{$value->translate(App::getLocale())->name}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input  type="file" id='image' name="image"
                                        class="form-control image2" enctype="multipart/form-data">
                                </div>

                                <div class="form-group">
                                    <img src="{{ $schools->image_path }}" style="width: 100px"
                                        class="img-thumbnail image-preview2" alt="">
                                </div> -->

                            </div>
                        </div>

                        <div class="form-group">
                            <label >@lang('site.address')</label>
                            <input type="text" name ='address' class="form-control" id="address" required>
                        </div>

                        <div class="form-group">

                            @if($errors->has('start_lat') || $errors->has('start_lng') || $errors->has('end_lat') || $errors->has('end_lng') )
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-warning"></i> @lang('admin.Warning') !</h4>
                                    @lang('site.Please move mark in maps')
                                </div>
                            @endif

                            <div id="map" style="height: 300px !important; position: relative; overflow: hidden;" ></div>
                        </div>

                        <input type="hidden"  class="form-control" id="lat"
                                name="lat" value="{!! $lat !!}">

                        <input type="hidden"  class="form-control" id="lng"
                            name="lng" value="{!! $lng !!}" >

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit') </button>
                        </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->

</div><!-- end of content wrapper -->
@endsection
