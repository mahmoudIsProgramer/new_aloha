@extends('layouts.dashboard.app')
<?php
$page="inbox";
$title=trans('site.inbox');
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
                        ( {{$inboxs->total()}} )
                    </small></h3>
                <form action="{{ route('dashboard.inbox.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-6">
                                <select name="state" class="form-control">
                                    <option value="">الحالة</option>
                                    <option value="2" {{ request()->state=="2" ? 'selected' :'' }}>لم يتم التواصل معه	   </option>
                                    <option value="1" {{ request()->state=="1" ? 'selected' :'' }}>تم التواصل	  </option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                        <!-- <a style="float:left" href="{{ url('dashboard/export_inbox') }}" class="btn btn-success  btn-sm">
                            Export Excel Sheet
                            <i
                            class="fa fa-file-excel-o"></i>
                        </a> -->
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th style="width: 10px">{{-- <input type="checkbox" id="select_all"/> --}}#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.message')</th>
                            <th>@lang('site.state')</th>

                            <th>@lang('site.action')</th>
                        </tr>
                        {{-- check if there are row supersliders or not --}}
                        @if ($inboxs->count() >0)
                        @foreach ($inboxs as $index=>$inbox)
                        <tr style="background-color:{{ $inbox->state=="2" ? '#f1d4d4' :'#04fb0938' }}">
                            <td>{{-- <input class="checkbox" type="checkbox" name="check[]"> --}}{{ $index + 1 }}</td>

                            <td>{{ $inbox->name }}</td>
                            <td>{{ $inbox->email }}</td>
                            <td>{{ $inbox->phone }}</td>
                            <td>{{ $inbox->message }}</td>
                            <td>
                                @if($inbox->state==2)
                                <small class="btn-xs btn-danger">لم يتم التواصل معه </small>
                                @else
                                <small class="btn-xs btn-success">تم التواصل</small>
                                @endif
                            </td>
                            <td>
                                <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{$index+1}}"><i
                                        class="fa fa-eye"></i>
                                    @lang('site.details')
                                </button> -->
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

                                                <strong>Type message</strong>&nbsp;&nbsp;&nbsp; {{
                                                $inbox->type_message }}
                                                <hr>
                                                <strong>@lang('site.email')</strong>&nbsp;&nbsp;&nbsp; {{
                                                $inbox->email }}
                                                <strong> @lang('site.phone') </strong> &nbsp;&nbsp;&nbsp; {{
                                                $inbox->phone }}
                                                <hr>
                                                <strong> @lang('site.message') </strong> <br> &nbsp;&nbsp;&nbsp; {{
                                                $inbox->message }}


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (auth()->user()->hasPermission('update_inbox'))
                                <a href="{{ route('dashboard.inbox.edit', $inbox->id) }}" class="btn btn-info  btn-sm"><i
                                        class="fa fa-edit"></i>
                                    @lang('site.activate')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.activate')</a>
                                @endif

                                @if (auth()->user()->hasPermission('delete_inbox') )
                                <form action="{{ route('dashboard.inbox.destroy', $inbox->id) }}" method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>
                                        @lang('site.delete')</button>
                                </form><!-- end of form -->
                                <!-- end of condtion parent id not = 0 -->
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
                {{ $inboxs->appends(request()->query())->links()}}
                <!-- /.box-body -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
