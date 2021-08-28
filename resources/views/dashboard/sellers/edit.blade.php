@extends('layouts.dashboard.app')
<?php
$page = 'sellers';
$title = trans('site.sellers');
?>
@section('title_page')
    {{ $title }}
@endsection

@push('js')

    <!-- start get states and regoins and streests  -->
    <script type="text/javascript">
        $(document).ready(function() {


            // change city
            $(document).on('change', '.city_id', function() {


                var city_id = $('.city_id option:selected').val();
                var token = $("input[name='_token']").val();
                $('.states').html('');
                $('.regoins').html('');
                if (city_id > 0) {
                    $.ajax({

                        url: "{!! route('dashboard.getStates') !!}",
                        type: 'get',
                        dataType: '',
                        data: {
                            city_id: city_id,
                            getData: 'states',
                            select: ''
                        },
                        success: function(data) {
                            $('.states').html(data);
                        }
                    });
                }
            }); // end city change

            // change state
            $(document).on('change', '.state_id', function() {

                var state_id = $('.state_id option:selected').val();
                var token = $("input[name='_token']").val();
                $('.regoins').html('');
                if (state_id > 0) {
                    $.ajax({

                        url: "{!! route('dashboard.getRegoins') !!}",
                        type: 'get',
                        dataType: '',
                        data: {
                            state_id: state_id,
                            getData: 'regoins',
                            select: ''
                        },
                        success: function(data) {
                            $('.regoins').html(data);
                        }
                    });
                }
            }); // end state change

            // states
            @if (old('state_id'))

                @php
                    $city_id = old('city_id');
                    $state_id = old('state_id');
                @endphp
                $.ajax({
                url:'{!! route('dashboard.getStates') !!}',
                type:'get',
                dataType:'html',
                data:{ city_id:{{ $city_id }},getData:'states' , select:{{ $state_id }} },
                success: function (data) {
                $('.states').html(data)
                }
                });

            @endif
            // regoins
            @if (old('regoin_id'))

                @php
                    $state_id = old('state_id');
                    $regoin_id = old('regoin_id');
                @endphp

                $.ajax({
                url:'{!! route('dashboard.getRegoins') !!}',
                type:'get',
                dataType:'html',
                data:{ state_id:{{ $state_id }},getData:'regoins' , select:{{ $regoin_id }} },
                success: function (data) {
                $('.regoins').html(data)
                }
                });

            @endif

        });
    </script>

@endpush

@section('content')


    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.sellers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.sellers.index') }}"> @lang('site.sellers')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.sellers.update', $seller->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.full_name')</label>
                                    <input required="required" type="text" name="full_name" class="form-control"
                                        value="{{ old('full_name') ?? $seller->full_name }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input required="required" type="text" name="email" class="form-control"
                                        value="{{ old('email') ?? $seller->email }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input required="required" type="phone" name="phone" class="form-control"
                                        value="{{ old('phone') ?? $seller->phone }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                </div>


                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image">
                                </div>

                                <div class="form-group">
                                    <img src="{{ $seller->image_path }}" style="width: 100px"
                                        class="img-thumbnail image-preview" alt="">
                                </div>


                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.company_name')</label>
                                    <input required="required" type="text" name="company_name" class="form-control"
                                        value="{{ old('company_name', $seller->company_name) }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.company_address')</label>
                                    <input required="required" type="text" name="company_address" class="form-control"
                                        value="{{ old('company_address', $seller->company_address) }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.commerical_register')</label>
                                    <input required="required" type="text" name="commerical_register" class="form-control"
                                        value="{{ old('commerical_register', $seller->commerical_register) }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.tax_card')</label>
                                    <input required="required" type="text" name="tax_card" class="form-control"
                                        value="{{ old('tax_card', $seller->tax_card) }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control" required>
                                        <option value="1" @if (old('status') == '1' || $seller->status == '1') selected @endif>@lang('site.Active')</option>
                                        <option value="0" @if (old('status') == '0' || $seller->status == '0') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.city')</label>
                                    <select name='city_id' class="form-control city_id" required>
                                        <option value="">@lang('site.city')</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @if (old('city_id') == $city->id || $seller->city_id == $city->id) selected @endif>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label>@lang('site.state')</label>
                                <div class="states">
                                    <select name='state_id' class="form-control state_id" required>
                                        <option value="">@lang('site.state')</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @if (old('state_id') == $state->id || $seller->state_id == $state->id) selected @endif>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>@lang('site.password')</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.password_confirmation')</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        @lang('site.edit') </button>
                                </div>
                            </div>


                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
