<div class="form-group">
  <label>@lang('site.operation')</label>
  <select name='operation_type' class="form-control  " @isset( $required ) required @endisset >
    <option value="">@lang('site.operation')</option>
    @foreach(wallet_operations() as $value )
    <option value="{{$value}}" @if(old('operation_type',request('operation_type'))==$value) selected @endif>{{ __('site.'.$value)}}
    </option>
    @endforeach
  </select>
</div>
