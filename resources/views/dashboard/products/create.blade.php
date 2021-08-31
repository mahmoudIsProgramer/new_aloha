@extends('layouts.dashboard.app')
<?php
$page = 'products';
$title = trans('site.products');
?>
@section('title_page')
    {{ $title }}
@endsection

@push('js')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '.category_id', function() {

                var category_id = $('.category_id option:selected').val();

                var token = $("input[name='_token']").val();
                $('.subcategories').html('');
                $('.subsubcategories').html('');

                if (category_id > 0) {
                    $.ajax({

                        url: "{!! route('dashboard.getSubcategories') !!}",
                        type: 'get',
                        dataType: '',
                        data: {
                            category_id: category_id,
                            getData: 'subcategories',
                            select: ''
                        },
                        success: function(data) {
                            $('.subcategories').html(data);
                        }
                    });
                }
            });

            /////////////////////////////////////
            $(document).on('change', '.subcategory_id', function() {

                var subcategory_id = $('.subcategory_id option:selected').val();

                var token = $("input[name='_token']").val();
                $('.subsubcategories').html('');

                if (subcategory_id > 0) {
                    // states
                    $.ajax({

                        url: "{!! route('dashboard.getSubsubcategories') !!}",
                        type: 'get',
                        dataType: '',
                        data: {
                            subcategory_id: subcategory_id,
                            getData: 'subsubcategories',
                            select: ''
                        },
                        success: function(data) {
                            $('.subsubcategories').html(data);
                        }
                    });
                }
            });

            @if (old('category_id'))

                @php
                    $category_id = old('category_id');
                    $subcategory_id = old('subcategory_id');
                @endphp
                $.ajax({
                url:'{!! route('dashboard.getSubcategories') !!}',
                type:'get',
                dataType:'html',
                data:{ category_id:{{ $category_id }},getData:'subcategories' , select:{{ $subcategory_id }} },
                success: function (data) {
                $('.subcategories').html(data)
                $('.subsubcategories').html('')
                }
                });
            @endif



            @if (old('subcategory_id'))

                @php
                    $subcategory_id = old('subcategory_id');
                    $subsubcategory_id = old('subsubcategory_id');
                @endphp
                $.ajax({
                url:'{!! route('dashboard.getSubsubcategories') !!}',
                type:'get',
                dataType:'html',
                data:{ subcategory_id:{{ $subcategory_id }},getData:'subsubcategories' , select:{{ $subsubcategory_id }} },
                success: function (data) {
                $('.subsubcategories').html(data)
                }
                });
            @endif

        });

    </script>

@endpush

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.properties')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.properties')</a></li>
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

                <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="created_by" value="{{ auth()->user()->full_name }}">

                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties)
                                        <li role="presentation" class="@if ($loop->first) active @endif"><a href="#{{ $locale }}"
                                                aria-controls="home" role="tab" data-toggle="tab">
                                                {{ $properties['native'] }} </a></li>
                                    @endforeach
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">

                                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties)
                                        <div role="tabpanel" class="tab-pane @if ($loop->first) active @endif" id="{{ $locale }}">

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.name')</label>
                                                <input type="text" name="{{ $locale }}[name]"
                                                    class="form-control" value="{{ old($locale . '.name') }}"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.short_description')</label>
                                                <textarea name="{{ $locale }}[short_description]" id=""
                                                    class="form-control" cols="30" rows="5"
                                                    required>{{ old($locale . '.short_description') }}</textarea>

                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.description')</label>
                                                <textarea name="{{ $locale }}[description]" id=""
                                                    class="form-control ckeditor" cols="30" rows="5"
                                                    required>{{ old($locale . '.description') }}</textarea>

                                            </div>

                                            <div class="enable_seo">
                                                <div class="form-group">
                                                    <label for="">@lang('site.' . $locale . '.seo_key')</label>
                                                    <input type="text" name="{{ $locale }}[seo_key]"
                                                        class="form-control" id="seo_key"
                                                        value="{{ old($locale . '.description') }}"
                                                        data-role="tagsinput">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">@lang('site.' . $locale . '.seo_des') </label>
                                                    <input type="text" name="{{ $locale }}[seo_des]"
                                                        class="form-control" id="seo_des"
                                                        value="{{ old($locale . '.description') }}"
                                                        data-role="tagsinput">
                                                </div>
                                            </div>

                                            <div class="  with-border"></div><br>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.porduct_sku_code')</label>
                                    <input type="text" name='porduct_sku_code' value="{{ old('porduct_sku_code') }}"
                                        class="form-control" id="porduct_sku_code">
                                </div>

                                @php
                                    $variations_array = ['color_id' => 'colors', 'size_id' => 'sizes', 'material_id' => 'materials', 'type_id' => 'types', 'ram_id' => 'rams', 'capacity_id' => 'capacities', 'sim_id' => 'sims'];
                                @endphp

                                @foreach ($variations_array as $key => $model)
                                    @include('dashboard.products.variations_inputs',['model'=>$model,'key'=>$key,'required'=>''])
                                @endforeach

                            </div>
                            <div class="col-md-6">

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
                                    <label>@lang('site.categories')</label>
                                    <select name='category_id' id='category_id' class="form-control category_id"
                                        required>
                                        <option value="">@lang('site.categories')</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" @if (old('category_id') == $item->id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.subcategories')</label>
                                    <div class="subcategories">
                                        <select name='subcategory_id' id='subcategory_id' class="form-control" required>
                                            <option value="">@lang('site.subcategories')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.subsubcategories')</label>
                                    <div class="subsubcategories">
                                        <select name='subsubcategory_id' id='subsubcategory_id' class="form-control"
                                            required>
                                            <option value="">@lang('site.subsubcategories')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.brand')</label>
                                    <select name='brand_id' id='brand_id' class="form-control">
                                        <option value="">@lang('site.brand')</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}" @if (old('brand_id') == $item->id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.products')</label>
                                    <select name='products[]' id='products' class="form-control selectpicker"
                                        data-live-search="true" multiple>
                                        <option value="">@lang('site.products')</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}"
                                                {{ collect(old('products'))->contains($item->id) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control">

                                        <option value="">@lang('site.status')</option>
                                        <option value="1" @if (old('status') == '1') selected @endif>@lang("site.Active")</option>
                                        <option value="0" @if (old('status') == '0') selected @endif>@lang("site.In-Active")</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.featured product')</label>
                                    <select name='featured' class="form-control">
                                        <option value="">@lang('site.featured product')</option>
                                        <option value="1" @if (old('featured') == '1') selected @endif>@lang("site.Yes")</option>
                                        <option value="0" @if (old('featured') == '0') selected @endif>@lang("site.No")</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>@lang('site.On Sale')</label>
                                    <select name='on_sale' class="form-control">
                                        <option value="">@lang('site.On Sale')</option>
                                        <option value="1" @if (old('on_sale') == '1') selected @endif>@lang("site.Yes")</option>
                                        <option value="0" @if (old('on_sale') == '0') selected @endif>@lang("site.No")</option>
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
                                    <input type="text" name='discount' value="{{ old('discount') }}"
                                        class="form-control" id="discount"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.stock')</label>
                                    <input type="text" name='stock' value="{{ old('stock') }}" class="form-control"
                                        id="stock" required
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input required="required" type="file" id='image' name="image"
                                        class="form-control image2">
                                    <label style="color: #aaa9a9;">{{ size_main_product() }}</label>
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                        class="img-thumbnail image-preview2" alt="">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.attachments')</label>
                                    <input required="required" type="file" id="gallery-photo-attachments"
                                        name="attachments[]" multiple class="form-control image">
                                    <label style="color: #aaa9a9;">{{ size_product_sliders() }}</label>
                                </div>

                                <div class="form-group gallery gallery_attachments">

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
