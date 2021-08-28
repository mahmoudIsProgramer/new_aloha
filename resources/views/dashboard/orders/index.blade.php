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
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
      </li>
      <li class="active">@lang('site.orders')</li>
    </ol>
  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title" style="margin-bottom: 15px">@lang('site.orders')
          <small>
            @lang('site.total_search')
            ( {{ $orders->total() }} )
          </small></h3>

        <form action="{{ route('dashboard.orders.index') }}" method="get">

          <div class="row">
            <div class='col-md-4'>
              <div class="form-group">
                <label>@lang('site.customers')</label>
                <select name='customer_id' class="form-control">
                  <option value="">@lang('site.customers')</option>
                  @foreach( $customers as $item )
                  <option value="{{ $item->id}}" @if( request('customer_id')==$item->id ) selected
                    @endif>{{ $item->full_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class='col-md-4'>
              <div class="form-group">
                <label>@lang('site.status')</label>
                <select name='status' class="form-control">
                  <option value="">@lang('site.status')</option>
                  @foreach (orderStatus() as $status )
                  <option value="{{$status}}" @if( $status==request('status') ) selected @endif> {{__('site.'.$status)}}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class='col-md-4'>
              <div class="form-group">
                <label>@lang('site.fromDate')</label>
                <input type='date' name='fromDate' value="{{request('fromDate')}}" class="form-control">
              </div>
            </div>

            <div class='col-md-4'>
              <div class="form-group">
                <label>@lang('site.toDate')</label>
                <input type='date' name='toDate' value="{{request('toDate')}}" class="form-control">
              </div>
            </div>

            <div class="col-md-12">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                @lang('site.search') </button>

              {{-- @if (auth()->user()->hasPermission('create_orders'))
                            <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i
                class="fa fa-plus"></i> @lang('site.add')</a>
              @else
              <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                @lang('site.add')</a>
              @endif --}}
            </div>

          </div>

          {{--  end propeties filtration  --}}
        </form><!-- end of form  filteration -->

      </div><!-- end of box header -->



      <div class="box-body">

        @if ($orders->count() > 0)

        <table class="table table-hover">

          <thead>
            <tr>
              <th>#</th>
              <th>@lang('site.Order Number')</th>
              <th>@lang('site.Order Type')</th>
              <th>@lang('site.Order Status')</th>
              <th>@lang('site.Payment Methods')</th>
              <th>@lang('site.Payment Status')</th>
              <th>@lang('site.customer')</th>
              <th>@lang('site.Total')</th>
              <th>@lang('site.promocode discount')</th>
              {{-- <th>@lang('site.discount')</th> --}}
              {{-- <th>@lang('site.promocode')</th> --}}
              {{-- <th>@lang('site.New Total')</th> --}}
              <th>@lang('site.created_at')</th>
              <th>@lang('site.action')</th>
            </tr>
          </thead>

          <tbody>
            @php
            $total=0 ;
            @endphp

            @foreach ( $orders as $order)

            @php
            $total+=$order->total ;
            @endphp

            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td>{{ $order->id }}</td>
              <td>{{ $order->order_type }}</td>
              <td>{{__('site.'. $order->status) }}</td>
              <td>{{ $order->payment_method }}</td>

              <td>
                {{-- {{ $order->payment_method }} --}}

                {{-- @if( $order->payment_method!='cacheOnDelivery' || $order->payment_method!='premium') --}}
                {!! paymentStatus($order->payment_status,$order->payment_method) !!}
                {{-- @endif --}}

              </td>

              <td>
                @if($customer = $order->customer)
                @include('dashboard.modals.customer')
                @endif
              </td>

              <td>{{  $order->total }}</td>

              {{-- <td>{{  $order->promocode }}</td> --}}
              <td>{{  $order->promocode_value }}</td>

              <td>{{ date("Y-m-d", strtotime($order->created_at))  }}</td>
              <td>

                <a href="" data-toggle="modal" data-target="#modal-trips{{$order->id}}">
                  <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i></button>
                </a>

                <div class="modal fade" id="modal-trips{{$order->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> {{$order->title}}</h4>
                      </div>
                      <div class="modal-body">
                        <div class="box box-primary">
                          <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{$order->title}}</h3>

                            <p class="text-muted text-center">@lang('site.Create since')
                              {{date('M-Y',strtotime($order->created_at))}}</p>
                            <table class="table table-hover">

                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>@lang('site.name')</th>
                                  <th>@lang('site.price')</th>
                                  {{-- <th>@lang('site.discount')</th> --}}
                                  <th>@lang('site.total')</th>
                                </tr>
                              </thead>

                              <tbody>

                                @foreach ( $order->products as $index=> $value)
                                <tr>
                                  <td>{{$loop->index +1}} </td>
                                  <td>{{$value->name }} </td>
                                  <td>{{$value->total}} </td>
                                  <td>{{$value->total * $value->pivot->qty}} </td>
                                </tr>
                                @endforeach

                              </tbody>
                            </table>
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
                {{--
                                @if (auth()->user()->hasPermission('update_orders'))
                                <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                @else
                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                  @lang('site.edit')</a>
                @endif --}}

                <a href="{{ route('dashboard.orderDetails', $order->id) }}" class="btn btn-info btn-sm"><i
                    class="fa fa-inof"></i> {{__('site.Order Details')}}</a>
                @if($order->status != 'returned' )
                <a href="{{ route('dashboard.returnOrder',['order'=>$order->id] ) }}" class="btn btn-danger btn-sm"><i
                    class="fa fa-inof"></i> {{__('site.Return Order')}}</a>
                @endif
              </td>

            </tr>
            @endforeach

          </tbody>

          <span>@lang('site.total') :{{$total}}</span>|
          {{ $orders->appends(request()->query())->links() }}

          @else
          <div class='col-md-12'>
            <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
          </div>
          @endif

        </table><!-- end of table -->



      </div><!-- end of box body -->


    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
