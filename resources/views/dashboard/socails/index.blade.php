@extends('layouts.dashboard.app')
<?php
$page="socail";
$title=trans('site.socail');
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
                        ( {{$socails->total()}} )
                    </small></h3>
            </div><!-- end of box header -->
            <div class="box-body">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.link')</th>
                            <th>@lang('site.updated_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        {{-- check if there are row supersliders or not --}}
                        @if ($socails->count() >0)
                        @foreach ($socails as $index=>$socail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><i class="fab {{ $socail->icon }}"></i> || {{ $socail->name }}</td>

                            <td style = "text-align:center"><a href="{{ $socail->link }}">{{ $socail->link }}</a></td>


                            <td>{{ $socail->updated_at }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_users'))
                                <a href="{{ route('dashboard.socail.edit', $socail->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
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
                {{ $socails->appends(request()->query())->links()}}
                <!-- /.box-body -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
