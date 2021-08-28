@extends('layouts.dashboard.app')
<?php
$page="deliveries";
$title=trans('site.deliveries');
?>
@section('title_page')
{{$title}}
@endsection

@push('js')

<!-- start get states and regoins and streests  -->
<script type="text/javascript">
  $(document).ready(function () {


            // change city
            $(document).on('change','.city_id',function () {


                var city_id = $('.city_id option:selected').val();
                var token = $("input[name='_token']").val();
                $('.states').html('') ;
                $('.regoins').html('') ;
                if ( city_id > 0 ){
                    $.ajax({

                        url:"{!! route('dashboard.getStates') !!}",
                        type:'get',
                        dataType:'',
                        data:{ city_id:city_id,getData:'states',select:''  },
                        success: function (data) {
                            $('.states').html(data) ;
                        }
                    });
                }
            }); // end city change

            // change state
            // $(document).on('change','.state_id',function () {

            //     var state_id = $('.state_id option:selected').val();
            //     var token = $("input[name='_token']").val();
            //     $('.regoins').html('') ;
            //     if ( state_id > 0 ){
            //         $.ajax({

            //             url:"{!! route('dashboard.getRegoins') !!}",
            //             type:'get',
            //             dataType:'',
            //             data:{ state_id:state_id,getData:'regoins',select:''  },
            //             success: function (data) {
            //                 $('.regoins').html(data) ;
            //             }
            //         });
            //     }
            // }); // end state change

            // states
            @if(old('state_id'))

                @php
                    $city_id = old('city_id');
                    $state_id = old('state_id');
                @endphp
                $.ajax({
                    url:'{!! route("dashboard.getStates") !!}',
                    type:'get',
                    dataType:'html',
                    data:{ city_id:{{ $city_id }},getData:'states' , select:{{ $state_id }}  },
                    success: function (data) {
                        $('.states').html(data)
                    }
                });

            @endif
            // regoins
            // @if(old('regoin_id'))

            //     @php
            //         $state_id = old('state_id');
            //         $regoin_id = old('regoin_id');
            //     @endphp

            //     $.ajax({
            //         url:'{!! route("dashboard.getRegoins") !!}',
            //         type:'get',
            //         dataType:'html',
            //         data:{ state_id:{{ $state_id }},getData:'regoins' , select:{{ $regoin_id }}  },
            //         success: function (data) {
            //             $('.regoins').html(data)
            //         }
            //     });

            // @endif


        });

</script>

@endpush


@section('content')


<div class="content-wrapper">
  <section class="content-header">

    <h1>@lang('site.deliveries')</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.deliveries.index') }}"> @lang('site.deliveries')</a></li>
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

        <form action="{{ route('dashboard.deliveries.store') }}" method="post" enctype="multipart/form-data">

          {{ csrf_field() }}
          {{ method_field('post') }}

          <div class="col-md-12">
            <div class="col-md-6">

              <div class="form-group">
                <label>@lang('site.price')</label>
                <input required="required" type="text" name="price" class="form-control" value="{{old('price')}}"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
              </div>
            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label>@lang('site.city')</label>
                <select name='city_id' class="form-control" required>
                  <option value="">@lang('site.city')</option>
                  @foreach($cities as $city )
                  <option value="{{$city->id}}" @if(old('city_id')==$city->id ) selected @endif>{{$city->name}}</option>
                  @endforeach
                </select>
              </div>

              {{-- <div class="form-group">
                <label>@lang('site.status')</label>
                <select name='status' class="form-control" required>
                  <option value="1" @if(old('status')=='1' ) selected @endif>@lang('site.Active')</option>
                  <option value="0" @if(old('status')=='0' ) selected @endif>@lang('site.In-Active')</option>
                </select>
              </div> --}}

              {{-- <label>@lang('site.state')</label>
                                <div class="states">
                                </div> --}}

              {{-- <label>@lang('site.regoin')</label>
                                <div class="regoins">
                                </div> --}}

            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add') </button>
              </div>
            </div>


          </div>


        </form><!-- end of form -->

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
