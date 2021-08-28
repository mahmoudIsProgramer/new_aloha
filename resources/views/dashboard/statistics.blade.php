@extends('layouts.dashboard.app')
<?php
$page="statistics";
$title=trans('site.statistics');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.statistics')</h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.statistics')</li>
        </ol>
    </section>

    <section class="content">
        <!-- new row -->
        <a href="{{ url('dashboard/categories') }}"> 
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        {{$total_views}}
                    </h3>
                    <p>@lang('site.total views')</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        </a>
        <!-- ./col -->
        <a href="{{ url('dashboard/users') }}"> 
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        
                        {{$total_clicks}}
                    </h3>
                    <p>@lang('site.total clicks')</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        </a>

        <!-- ./col -->
        <a href="{{ url('dashboard/clients') }}">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        
                        {{$percnet_of_clicks}} %
                    </h3>
                    <p>@lang('site.percnet of clicks')</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        </a>

        <!-- ./col -->
        <a href="{{ url('dashboard/brands') }}">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        
                        {{ $total_orders }}
                    </h3>
                    <p>@lang('site.total customer ordres')</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        </a>

        <!-- ./col -->
        <a href="{{ url('dashboard/brands') }}">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        
                        {{ $Shift_ratio }} %
                    </h3>
                    <p>@lang('site.Shift ratio')</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        </a>


        <!-- ./col -->     
    </section><!-- end of content -->

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.statistics')
            
            </div><!-- end of box header -->

            <div class="box-body">

                @if ($statistics->count() > 0)

                <table class="table table-hover">
                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.date')</th>
                            <th>@lang('site.total views')</th>
                            <th>@lang('site.total clicks')</th>
                            <th>@lang('site.percnet of clicks')</th>
                            <th>@lang('site.Shift ratio')</th>
                            <th>@lang('site.orders')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ( $statistics as $index=>$item)
                        <tr>
                            <td>  {{ $index + 1 }}</td>
                            <td>  {{ $item->date }}</td>
                            <td>  {{ $item->views }}</td>
                            <td>  {{ $item->clicks  }} </td>
                            
                            @php
                                $views =  ($item->views!=0)?$item->views:1 ;   
                                $clicks =  ($item->clicks!=0)?$item->clicks:1 ;  
                            @endphp 
    
                            <td>  {{   ceil( ( $item->clicks /  $views   ) * 100  ) }} % </td>
                            <td>  {{   ceil( ( $item->orders /  $clicks   ) * 100  ) }} %</td>
                            <td>  {{ $item->orders  }} </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table> <!-- end of table -->

                {{ $statistics->appends(request()->query())->links() }}

                @else
                    <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->


</div><!-- end of content wrapper -->

@endsection
