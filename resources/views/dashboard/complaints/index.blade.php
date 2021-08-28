@extends('layouts.dashboard.app')
<?php
$page="complaints";
$title=trans('site.complaints');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <!-- title head  -->
    <h1>{{$title}}</h1>
    <!-- breadcrumb  -->
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>@lang('site.Dashboard')</a></li>
      <li class="active">{{$title}}</li>
    </ol>
    <!--/* breadcrumb  -->
  </section>
  <section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title" style="margin-bottom: 15px">{{$title}} <small>@lang('site.total_search')
            ( {{$complaints->total()}} )
          </small></h3>
        <form action="{{ route('dashboard.complaints.index') }}" method="get">
          <div class="row">
            <div class="col-md-6">
              {{-- <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                  value="{{ request()->search }}">
            </div> --}}

            <div class="col-md-6">
              <select name="state" class="form-control">
                <option value="">الحالة</option>
                <option value="0" {{ request()->state=="2" ? 'selected' :'' }}>لم يتم التواصل معه
                </option>
                <option value="1" {{ request()->state=="1" ? 'selected' :'' }}>تم التواصل </option>
              </select>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                @lang('site.search')</button>
            </div>
          </div>

      </div>
      </form><!-- end of form -->
    </div><!-- end of box header -->
    <div class="box-body">
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover">
          <tr>
            <th style="width: 10px"> #</th>
            <th>@lang('site.customer')</th>
            <th>@lang('site.state')</th>
            <th>@lang('site.image')</th>

            <th>@lang('site.action')</th>
          </tr>
          @if ($complaints->count() >0)
          @foreach ($complaints as $index=>$complaint)


          {{-- {{ dd($complaint->customer) }} --}}
          <tr style="background-color:{{ $complaint->state=="2" ? '#f1d4d4' :'#04fb0938' }}">

            <td> {{ $complaint->id }}</td>
            <td>@include('dashboard.modals.customer',['customer'=>$complaint->customer])</td>
            <td>
              @if($complaint->state==0)
              <small class="btn-xs btn-danger">لم يتم التواصل معه </small>
              @else
              <small class="btn-xs btn-success">تم التواصل</small>
              @endif
            </td>

            <td>
              <a href="{{ $complaint->image_path }}" data-fancybox data-caption="Caption for single image">
                <img src="{{ $complaint->image_path }}" style="width: 100px;" class="img-thumbnail" alt="">
              </a>
            </td>

            <td>
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#exampleModalCenter{{$index+1}}"><i class="fa fa-eye"></i>
                @lang('site.details')
              </button>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter{{$index+1}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">
                        @lang('site.details')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <hr>
                      <strong> @lang('site.message') </strong> <br> &nbsp;&nbsp;&nbsp; {{
                                                $complaint->complaint }}

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              @if (auth()->user()->hasPermission('update_complaints'))
              <a href="{{ route('dashboard.complaints.edit', $complaint->id) }}" class="btn btn-info
              btn-sm"><i class="fa fa-edit"></i>
                @lang('site.activate')</a>
              @else
              <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                @lang('site.activate')</a>
              @endif

              @if (auth()->user()->hasPermission('delete_complaints') )
              <form action="{{ route('dashboard.complaints.destroy', $complaint->id) }}" method="post"
                style="display: inline-block">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>
                  @lang('site.delete')</button>
              </form><!-- end of form -->
              @else
              <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                @lang('site.delete')</button>
              @endif
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="8" class="text-center">
              <div class="alert alert-danger">
                <strong> @lang('site.no_data_found')</strong>
              </div>
            </td>
          </tr>
          @endif
        </table> <!-- /end of table -->
      </div>
      {{ $complaints->appends(request()->query())->links()}}
      <!-- /.box-body -->
    </div><!-- end of box body -->
</div><!-- end of box -->
</section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
