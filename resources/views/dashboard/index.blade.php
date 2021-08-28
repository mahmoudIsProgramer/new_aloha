@extends('layouts.dashboard.app')
<?php
$page = 'dashboard';
$title = trans('site.dashboard');
$locale = app()->getLocale();
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>

        </section>

        <section class="content">

            <div class=row>
                <div class="col-md-6">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-th"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.category') }}</span>
                                    <span class="info-box-number">{{ $categories }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.subcategories') }}</span>
                                    <span class="info-box-number">{{ $subcategories }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.products') }}</span>
                                    <span class="info-box-number">{{ $products }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>


                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.taxes') }}</span>
                                    <span class="info-box-number">{{ $taxes }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.brands') }}</span>
                                    <span class="info-box-number">{{ $brands }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->


                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-dropbox"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.stocks') }}</span>
                                    <span class="info-box-number">{{ $stocks }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-truck"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ __('site.deliveries') }}</span>
                                    <span class="info-box-number">{{ $deliveries }}</span>
                                </div>

                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->


                    </div>
                    <!-- /.row -->
                </div>
                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('site.Latest Members') }}</h3>

                            <div class="box-tools pull-right">
                                <span class="label label-danger">8 {{ __('site.New Members') }} </span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @foreach ($latest_customers as $customer)
                                    <li>
                                        <img src="{{ $customer->image_path }}" alt="User Image">
                                        <a class="users-list-name" href="#">{{ $customer->full_name }}</a>
                                        <span class="users-list-date">{{ $customer->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('dashboard.customers.index') }}"
                                class="uppercase">{{ __('site.View All Users') }}</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <div class="col-md-12">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $orders }}</h3>

                                    <p>{{ __('site.New Orders') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-newspaper-o"></i>
                                </div>
                                <a href="{{ route('dashboard.orders.index') }}"
                                    class="small-box-footer">{{ __('site.More info') }} <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">

                                    <h3>{{ $total_sale }}</sup></h3>

                                    <p>{{ __('site.Total Sale') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <a href="#" class="small-box-footer">{{ __('site.More info') }} <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ $customers }}</h3>

                                    <p>{{ __('site.User Registrations') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('dashboard.customers.index') }}"
                                    class="small-box-footer">{{ __('site.More info') }} <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ $cities }}</h3>

                                    <p>{{ __('site.cities') }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <a href="{{ route('dashboard.customers.index') }}"
                                    class="small-box-footer">{{ __('site.More info') }} <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>






            <!-- ./col -->
            <!-- <ion-icon name="notifications"></ion-icon> -->
            <!-- <ion-icon name="paper-plane"></ion-icon>
            <ion-icon name="contacts"></ion-icon> -->



            <div class="container-fluid">
                <h3 class="box-title">{{ __('site.Latest Products') }}</h3>
                <div class="box">

                    <div class="box-body table-responsive no-padding table-responsiveAll">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.' . $locale . '.name')</th>
                                    <th>@lang('site.category')</th>
                                    {{-- <th>@lang('site.subcategory')</th> --}}
                                    <th>@lang('site.brand')</th>
                                    <th>@lang('site.sale_price')</th>
                                    <th>@lang('site.discount')</th>
                                    <th>@lang('site.stock')</th>
                                    <th>@lang('site.Stock Limit')</th>
                                    <th>@lang('site.status')</th>
                                    <th>@lang('site.featured')</th>
                                    <th>@lang('site.trending')</th>
                                    <th>@lang('site.on_sale')</th>
                                    <th>@lang('site.hot_deal')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.action')</th>
                                </tr>

                                @foreach ($latest_products as $index => $value)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->category->name ?? '' }}</td>
                                        {{-- <td>{{  $value->subcategory->name }}</td> --}}
                                        <td>{{ $value->brand->name ?? '' }}</td>
                                        <td>{!! $value->discount !!}</td>
                                        <td>{!! $value->stock !!}</td>
                                        <td>{!! $value->stock_limit_alert !!}</td>
                                        <td>{!! activeColumn($value->status) !!}</td>
                                        <td>{!! activeColumn($value->featured) !!}</td>
                                        <td>{!! activeColumn($value->trending) !!}</td>
                                        <td>{!! activeColumn($value->on_sale) !!}</td>
                                        <td>{!! activeColumn($value->hot_deal) !!}</td>

                                        <td><img src="{{ $value->image_path }}" style="width: 100px;"
                                                class="img-thumbnail" alt=""></td>
                                        <td>

                                            <a href="" data-toggle="modal" data-target="#modal-trips{{ $value->id }}">
                                                <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i></button>
                                            </a>

                                            <div class="modal fade" id="modal-trips{{ $value->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title"> {{ $value->title }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="box box-primary">
                                                                <div class="box-body box-profile">
                                                                    <h3 class="profile-username text-center">
                                                                        {{ $value->name }}
                                                                    </h3>

                                                                    <p class="text-muted text-center">@lang('site.Create
                                                                        since')
                                                                        {{ date('M-Y', strtotime($value->created_at)) }}</p>

                                                                    <ul class="list-group list-group-unbordered">


                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.number_views')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->number_views !!}
                                                                            </a>
                                                                        </li>


                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.hot_deal')</b>
                                                                            <a class="pull-right">
                                                                                {!! activeColumn($value->hot_deal) !!}
                                                                            </a>
                                                                        </li>

                                                                        @if ($value->hot_deal == 1)
                                                                            <li class="list-group-item">
                                                                                <b><i class="fa fa-user margin-r-5"
                                                                                        aria-hidden="true"></i>@lang('site.hot_deal_price')</b>
                                                                                <a class="pull-right">
                                                                                    {!! $value->hot_deal_price !!}
                                                                                </a>
                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                <b><i class="fa fa-user margin-r-5"
                                                                                        aria-hidden="true"></i>@lang('site.expire_date_hot_deal')</b>
                                                                                <a class="pull-right">
                                                                                    {{ date('Y-m-d', strtotime($value->expire_date_hot_deal)) }}
                                                                                </a>
                                                                            </li>

                                                                        @endif

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.product_code')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->product_code !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.porduct_sku_code')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->porduct_sku_code !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.product_serial_number')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->product_serial_number !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.product_shipping_number')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->product_shipping_number !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.subcategory')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->subcategory->name ?? '' !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.link_youtube')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->link_youtube !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.short_description')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->short_description !!}
                                                                            </a>
                                                                        </li>

                                                                        <li class="list-group-item">
                                                                            <b><i class="fa fa-user margin-r-5"
                                                                                    aria-hidden="true"></i>@lang('site.description')</b>
                                                                            <a class="pull-right">
                                                                                {!! $value->description !!}
                                                                            </a>
                                                                        </li>

                                                                        <label for="">{{ __('site.images') }}</label>
                                                                        @foreach ($value->productImages as $item)
                                                                            <li class="list-group-item">
                                                                                <img src="{{ $item->image_path }}"
                                                                                    style="width: 20000px;"
                                                                                    class="img-thumbnail" alt="">
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>


                                                                <!-- /.box-body -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left"
                                                                data-dismiss="modal">@lang('site.Close')</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </section><!-- end of content -->



    </div><!-- end of content wrapper -->

@endsection
