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


        // // enable seo
        // $(".seo_checkbox").change(function() {
        //     $('.enable_seo').toggleClass("hidden");
        // });

        // append price and expire date
        $(".hot_deal").change(function() {
            $html = `
                        <label >@lang('site.hot_deal_price')</label>
                        <input type="text" name ='hot_deal_price'  value="{{ old('hot_deal_price') }}" class="form-control" id="hot_deal_price" required  >

                        <label >@lang('site.expire_hot_deal_date')</label>
                        <input type="date" name ='expire_hot_deal_date'  value="{{ old('expire_hot_deal_date') }}" class="form-control" id="expire_hot_deal_date" required>

                        <label >@lang('site.expire_hot_deal_time')</label>
                        <input type="time" name ='expire_hot_deal_time'  value="{{ old('expire_hot_deal_time') }}" class="form-control" id="expire_hot_deal_time" required>

                        `;
            if (this.value == '1') {
                $('.hot_deal_data').html($html);
            } else {
                $('.hot_deal_data').empty();
            }
        });
    </script>
@endpush

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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

                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="updated_by" value="{{ auth()->user()->full_name }}">

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
                                                        class="form-control" value="{!! $product->translate($locale)->name ?? '' !!}">
                                                </div>

                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale . '.short_description')</label>
                                                    <textarea name="{{ $locale }}[short_description]" id=""
                                                        class="form-control" cols="30"
                                                        rows="5">{!! $product->translate($locale)->short_description ?? '' !!}</textarea>

                                                </div>

                                                <div class="form-group">
                                                    <label>@lang('site.' . $locale . '.description')</label>
                                                    <textarea name="{{ $locale }}[description]" id=""
                                                        class="form-control ckeditor" cols="30"
                                                        rows="5">{!! $product->translate($locale)->description ?? '' !!}</textarea>

                                                </div>

                                                <div class="enable_seo">
                                                    <div class="form-group">
                                                        <label for="">@lang('site.' . $locale . '.seo_key')</label>
                                                        <input type="text" name="{{ $locale }}[seo_key]"
                                                            class="form-control" id="seo_key"
                                                            value="{{ $product->translate($locale)->seo_key ?? '' }}"
                                                            data-role="tagsinput">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">@lang('site.' . $locale . '.seo_des') </label>
                                                        <input type="text" name="{{ $locale }}[seo_des]"
                                                            class="form-control" id="seo_des"
                                                            value="{{ $product->translate($locale)->seo_des ?? '' }}"
                                                            data-role="tagsinput">
                                                    </div>
                                                </div>

                                                <div class="  with-border"></div><br>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.product_code')</label>
                                        <input type="text" name='product_code'
                                            value="{{ old('product_code') ?? $product->product_code }}"
                                            class="form-control" id="product_code">
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
                                            <option value="{{ $item->id }}" @if (old('seller_id',$product->seller_id) == $item->id) selected @endif>{{ $item->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <label>@lang('site.category')</label>
                                        <select name='category_id' id='category_id' class="form-control category_id"
                                            required>
                                            <option value="">@lang('site.category')</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" @if (old('category_id') == $item->id || $product->category_id == $item->id) selected @endif> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group subcategories">
                                        <label>@lang('site.subcategories')</label>
                                        <select name='subcategory_id' id='subcategory_id' class="form-control" required>
                                            <option value="">@lang('site.subcategories')</option>
                                            @foreach ($subcategories as $item)
                                                <option value="{{ $item->id }}" @if (old('subcategory_id') == $item->id || $product->subcategory_id == $item->id) selected @endif> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>@lang('site.subsubcategories')</label>
                                        <div class="subsubcategories">
                                            <select name='subsubcategory_id' id='subsubcategory_id'
                                                class="form-control subsubcategory_id" >
                                                <option value="">@lang('site.subsubcategories')</option>
                                                @foreach ($subsubcategories as $item)
                                                    <option value="{{ $item->id }}" @if (old('subsubcategory_id', $product->subsubcategory_id) == $item->id) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>@lang('site.Brand')</label>
                                        <select name='brand_id' class="form-control" required>
                                            <option value="">@lang('site.Brand')</option>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}" @if (old('brand_id') == $item->id || $product->brand_id == $item->id) selected @endif> {{ $item->name }}</option>
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
                                                  {{ collect(old('products', explode(',',$product->grouped_products) ) )->contains($item->id) ? 'selected' : '' }}>
                                                  {{ $item->name }}
                                              </option>
                                          @endforeach
                                      </select>
                                  </div>

                                    <div class="form-group">
                                        <label>@lang('site.status')</label>
                                        <select name='status' class="form-control">

                                            <option value="">@lang('site.status')</option>
                                            <option value="1" @if (old('status') == '1' || $product->status == '1') selected @endif>@lang("site.Active")</option>
                                            <option value="0" @if (old('status') == '0' || $product->status == '0') selected @endif>@lang("site.In-Active")</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.featured product')</label>
                                        <select name='featured' class="form-control">
                                            <option value="">@lang('site.featured product')</option>
                                            <option value="1" @if (old('featured') == '1' || $product->featured == '1') selected @endif>@lang("site.Yes")</option>
                                            <option value="0" @if (old('featured') == '0' || $product->featured == '0') selected @endif>@lang("site.No")</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.On Sale')</label>
                                        <select name='on_sale' class="form-control">
                                            <option value="">@lang('site.On Sale')</option>
                                            <option value="1" @if (old('on_sale') == '1' || $product->on_sale == '1') selected @endif>@lang("site.Yes")</option>
                                            <option value="0" @if (old('on_sale') == '0' || $product->on_sale == '0') selected @endif>@lang("site.No")</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.selling_price')</label>
                                        <input type="text" name='selling_price'
                                            value="{{ old('selling_price') ?? $product->selling_price }}" class="form-control"
                                            id="selling_price" required
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.discount')</label>
                                        <input type="text" name='discount'
                                            value="{{ old('discount') ?? $product->discount }}" class="form-control"
                                            id="discount"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.image')</label>
                                        <input type="file" id='image' name="image" class="form-control image2"
                                            enctype="multipart/form-data">
                                        <label style="color: #aaa9a9;">{{ size_main_product() }}</label>

                                    </div>

                                    <div class="form-group">
                                        <img src="{{ $product->image_path }}" style="width: 100px"
                                            class="img-thumbnail image-preview2" alt="">

                                    </div>

                                    <div class="form-group">

                                        <input type="file" name="attachments[]" multiple class="form-control"
                                            enctype="multipart/form-data">
                                        <label style="color: #aaa9a9;">{{ size_product_sliders() }}</label>
                                        @foreach ($attachments as $imgs)
                                            <a href="{{ url('dashboard/deleteImage/products') . '/' . $imgs['id'] }}"
                                                onclick="return confirm('{{ trans('site.confirm_delete') }}')"
                                                class="confirm btn btn-danger img-thumbnail image-preview" style="    width: 100px;
                                                        " title="Delete this item">
                                                <i class="fa fa-trash"></i><br>
                                                <img src="{{ $imgs->image_path }}" class="img-thumbnail image-preview"
                                                    alt="">
                                            </a>
                                        @endforeach

                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection


@section('scripts')

@endsection
