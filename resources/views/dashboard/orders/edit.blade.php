@extends('layouts.dashboard.app')
<?php
$page="orders";
$title=trans('site.orders');
?>

@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.orders')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.orders.index') }}"> @lang('site.orders')</a></li>
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

                <form action="{{ route('dashboard.orders.update',['order'=>$order->id]) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control" required>
                                        <option value="">@lang('site.status')</option>
                                        @foreach (orderStatus() as $status )
                                            <option value="{{$status}}" @if( $status == $order->status ) selected @endif> {{__('site.'.$status)}}  </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        @lang('site.edit')</button>
                                </div>

                            </div>

                        </div>
                    </div>



                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
