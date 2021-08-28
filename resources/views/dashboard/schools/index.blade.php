@extends('layouts.dashboard.app')
<?php
$page="schools";
$title=trans('site.schools');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.schools')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.schools')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.schools')
                    <small>
                        @lang('site.total_search')
                        ( {{ $schools->total() }} )
                    </small></h3>

                <form action="{{ route('dashboard.schools.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <select name='approved' class="form-control" >

                                    <option value="">@lang('site.status')</option>
                                    <option value="2" @if(request()->approved == '2') selected @endif>@lang('site.Active')</option>
                                    <option value="1" @if(request()->approved == '1') selected @endif>@lang('site.In-Active')</option>

                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_schools'))
                            <a href="{{ route('dashboard.schools.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($schools->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.college')</th>

                            <!-- <th>@lang('site.city')</th> -->
                            <th>@lang('site.state')</th>
                            <!-- <th>@lang('site.status')</th> -->
                            <!-- <th>@lang('site.image')</th> -->

                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ( $schools as $index=>$value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $value->name }}</td>
                            <td> {{ $value->address }}</td>
                            <td> {{ $value->email }}</td>
                            <td> {{ $value->phone }}</td>
                            <td> {{ __('site.'.$value->college) }}</td>

                            <!-- <td> {{ App\CityTranslation::where('city_id', $value->city_id)->where('locale',app()->getLocale())->value('name')??"" }}</td> -->
                            <td> {{ $value->state->name }}</td>

                            <!-- @if($value->approved == 2)
                                <td><span class="label label-success">@lang('site.Active')</span></td>
                            @else
                                <td><span class="label label-warning">@lang('site.In-Active')</span></td>
                            @endif -->

                            <!-- <td><img src="{{ $value->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""> -->
                            </td>

                            <td>

                                {{-- start view  user  --}}
                                @if( Auth::user()->hasPermission('read_schools') )

                                    <a href="" data-toggle="modal" data-target="#modal-trips{{$value->id}}">
                                        <button class="btn btn-success btn-xs"><i class="fa fa-eye "></i></button>
                                    </a>

                                    <div class="modal fade" id="modal-trips{{$value->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="box box-primary">
                                                        <div class="box-body box-profile">


                                                            <ul class="list-group list-group-unbordered">

                                                                <li class="list-group-item">
                                                                    <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i> @lang('site.name')</b>
                                                                    <a class="pull-right">
                                                                        {!! $value->name !!}
                                                                    </a>
                                                                </li>

                                                                <li class="list-group-item">
                                                                    <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>@lang('site.address')</b>
                                                                    <a class="pull-right">
                                                                        {!! $value->address !!}
                                                                    </a>
                                                                </li>

                                                                <li class="list-group-item">
                                                                    <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i> @lang('site.email')</b>
                                                                    <a class="pull-right">
                                                                        {!! $value->email !!}
                                                                    </a>
                                                                </li>

                                                                <li class="list-group-item">
                                                                    <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>@lang('site.phone')</b>
                                                                    <a class="pull-right">
                                                                        {!! $value->phone !!}
                                                                    </a>
                                                                </li>

                                                                <li class="list-group-item">
                                                                    <b><i class="fa fa-bus margin-r-5" aria-hidden="true"></i>@lang('site.state')</b>
                                                                    <a class="pull-right">
                                                                        {!! $value->state->name !!}
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>

                                                        <img src="{{ $value->image_path }}" style="width: 100px;" class="img-thumbnail" alt="">



                                                        <!-- /.box-body -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('site.Close')</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                @else
                                    <a class="active"  data-toggle="modal">
                                        <button class="btn btn-warning btn-xs disabled"><i class="fa fa-eye "></i></button>
                                    </a>
                                @endif
                                {{-- end view user  --}}

                                @if (auth()->user()->hasPermission('update_schools'))
                                <a href="{{ route('dashboard.schools.edit', $value->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_schools'))
                                <form action="{{ route('dashboard.schools.destroy', $value->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('site.delete')</button>
                                @endif
                            </td>

                        </tr>

                        @endforeach
                    </tbody>

                </table><!-- end of table -->

                {{ $schools->appends(request()->query())->links() }}

                @else
                <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection
