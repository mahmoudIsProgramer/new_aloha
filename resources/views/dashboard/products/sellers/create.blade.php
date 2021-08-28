@extends('layouts.dashboard.app')
<?php
$page = 'sellers';
$title = trans('site.sellers');
?>
@section('title_page')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.sellers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>
                        @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index', ['search' => $product->name]) }}">
                        {{ $product->name }}}</a></li>
                <li><a href="{{ route('dashboard.products.sellers.index', ['product' => $product->id]) }}">
                        @lang('site.specification')</a></li>
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

                    <form id="my-form"
                        action="{{ route('dashboard.products.sellers.store', ['product' => $product->id]) }}"
                        method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}


                        <div class="form-group">
                            <label>@lang('site.sellers')</label>
                            <select name='seller_id' id='seller_id' class="form-control selectpicker"
                                data-live-search="true" required>
                                <option value="">@lang('site.sellers')</option>
                                @foreach ($sellers as $item)
                                    <option value="{{ $item->id }}" @if (old('seller_id') == $item->id) selected @endif>{{ $item->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.selling_price')</label>
                            <input type="text" name='selling_price' value="{{ old('selling_price') }}"
                                class="form-control" id="selling_price" required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.discount')</label>
                            <input type="text" name='discount' value="{{ old('discount') }}" class="form-control"
                                id="discount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="text" name='stock' value="{{ old('stock') }}" class="form-control" id="stock"
                                required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.sku')</label>
                            <input type="text" name='sku' value="{{ old('sku') }}" class="form-control" id="sku"
                                required>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.seller_notes')</label>
                            <textarea name="seller_notes" id="" class="form-control" cols="30" rows="5"
                                required>{{ old('seller_notes') }}</textarea>

                        </div>

                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name='status' class="form-control" required>
                                <option value="1" @if (old('status') == '1') selected @endif>@lang('site.Active')</option>
                                <option value="0" @if (old('status') == '0') selected @endif>@lang('site.In-Active')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button> --}}
                            <input type='submit' class="btn btn-primary btn_loading" id='btn-submit' value='save'>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
