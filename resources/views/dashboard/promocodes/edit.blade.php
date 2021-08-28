@extends('layouts.dashboard.app')
<?php
$page="promocodes";
$title=trans('site.promocodes');
?>
@section('title_page')
{{$title}}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.promocodes')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.promocodes.index') }}"> @lang('site.promocodes')</a></li>
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

                    <form action="{{ route('dashboard.promocodes.update', $promocodes->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="row">


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.title')</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title')??$promocodes->title }}" >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.description')</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('description')??$promocodes->description }}" >
                                </div>


                                <div class="form-group">
                                    <label>@lang('site.code')</label>
                                    <input required="required"  type="text" name="code" class="form-control" value="{{ old('code')??$promocodes->code }}" required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.limit')</label>
                                    <input required="required"  type="text" name="limit" class="form-control" value="{{ old('limit')??$promocodes->limit }}" required  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.startDate')</label>
                                    <input required="required"  type="date" name="startDate" class="form-control" value="{{ old('startDate')??date('Y-m-d',strtotime($promocodes->startDate)) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.endDate')</label>
                                    <input required="required"  type="date" name="endDate" class="form-control" value="{{ old('endDate')??date('Y-m-d',strtotime($promocodes->endDate)) }}" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control"   required >
                                        <option value="1" @if(old('status') == '1' || $promocodes->status=='1') selected @endif>@lang('site.Active')</option>
                                        <option value="0" @if(old('status') == '0' || $promocodes->status=='0') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                                    <label>@lang('site.for_customers_has_one_order')</label>
                                    <select name='for_customers_has_one_order' class="form-control"   required >
                                        <option value="1" @if(old('for_customers_has_one_order') == '1' || $promocodes->for_customers_has_one_order=='1') selected @endif>@lang('site.Yes')</option>
                                        <option value="0" @if(old('for_customers_has_one_order') == '0' || $promocodes->for_customers_has_one_order=='0') selected @endif>@lang('site.No')</option>
                                    </select>
                                </div> --}}

                                <div class="form-group">
                                    <label>@lang('site.unit type')</label>
                                    <select name='type' class="form-control" required >
                                        <option value="">@lang('site.unit type')</option>
                                        <option value="value" @if(old('type') == 'value'|| $promocodes->type=='value') selected @endif>@lang('site.value')</option>
                                        <option value="percent"  @if(old('type') == 'percent'|| $promocodes->type=='percent') selected @endif>@lang('site.percent')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.discount_amount')</label>
                                    <input required="required"  type="text" name="discount_amount" class="form-control" value="{{ old('discount_amount')??$promocodes->discount_amount }}" required  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
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


<script type="text/javascript">

    $(function () {
        $("#buttonAdd").bind("click", function () {
            var div = $("<div />");
            div.html(GenerateTextbox(""));
            $("#TextBoxContainer").append(div);
        });

        $("body").on("click", ".remove", function () {
            $(this).closest("div").remove();
        });
    });

    function GenerateTextbox() {

        return '<div class="form-group"> <input name = "bundle[]" type="text" value = "" required autofocus placeholder = "bundle name" /> ' +
            '<input name = "price[]" type="text" value = "" required autofocus  placeholder= "price"  /> '+
            '<input type="button" value="Remove" class="remove"  /></div>'  ;
    }

</script>
@endsection
