<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <div class='row'>

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.status')</label>
          <select name='status' class="form-control" required>
            <option value="1" @if(request('status')=='1' ) selected @endif>@lang('site.Active')</option>
            <option value="0" @if(request('status')=='0' ) selected @endif>@lang('site.In-Active')</option>
          </select>
        </div>
      </div>


      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.Category')</label>
          <select name='category_id' class="form-control">
            <option value="">@lang('site.Category')</option>
            @foreach( $categories as $item )
            <option value="{{ $item->id}}" @if( request('category_id')==$item->id ) selected @endif>{{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.Subcategory')</label>
          <select name='subcategory_id' class="form-control">
            <option value="">@lang('site.Subcategory')</option>
            @foreach( $subcategories as $item )
            <option value="{{ $item->id}}" @if( request('subcategory_id')==$item->id ) selected @endif>{{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.Subsubcategory')</label>
          <select name='subsubcategory_id' class="form-control">
            <option value="">@lang('site.Subsubcategory')</option>
            @foreach( $subsubcategories as $item )
            <option value="{{ $item->id}}" @if( request('subsubcategory_id')==$item->id ) selected @endif>{{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.Brand')</label>
          <select name='brand_id' class="form-control">
            <option value="">@lang('site.Brand')</option>
            @foreach( $brands as $item )
            <option value="{{ $item->id}}" @if( request('brand_id')==$item->id ) selected @endif>{{ $item->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.featured product')</label>
          <select name='featured' class="form-control">
            <option value="">@lang('site.featured product')</option>
            <option value="1" @if(request("featured")=="1" ) selected @endif>@lang("site.Yes")</option>
            <option value="0" @if(request("featured")=="0" ) selected @endif>@lang("site.No")</option>
          </select>
        </div>
      </div>

      {{-- <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.trending product')</label>
          <select name='trending' class="form-control">
            <option value="">@lang('site.trending product')</option>
            <option value="1" @if(request("trending")=="1" ) selected @endif>@lang("site.Yes")</option>
            <option value="0" @if(request("trending")=="0" ) selected @endif>@lang("site.No")</option>
          </select>
        </div>
      </div> --}}

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.On Sale')</label>
          <select name='on_sale' class="form-control">
            <option value="">@lang('site.On Sale')</option>
            <option value="1" @if(request("on_sale")=="1" ) selected @endif>@lang("site.Yes")</option>
            <option value="0" @if(request("on_sale")=="0" ) selected @endif>@lang("site.No")</option>
          </select>
        </div>
      </div>

      {{-- <div class='col-md-4'>
        <label>@lang('site.Hot Deal')</label>
        <select name='hot_deal' class="form-control hot_deal">
          <option value="">@lang('site.Deal Of Day')</option>
          <option value="1" @if(request("hot_deal")=="1" ) selected @endif>@lang("site.Yes")</option>
          <option value="0" @if(request("hot_deal")=="0" ) selected @endif>@lang("site.No")</option>
        </select>
      </div> --}}

      <div class='col-md-4'>
        <div class="form-group">
          <label>@lang('site.created_at')</label>
          <input type='date' name='created_at' value="{{request('created_at')}}" class="form-control">
        </div>
      </div>

    </div>

  </div>
</div>
