<div class="form-group">
    <label>@lang('site.customers')</label>
    <select name='customer_id' class="form-control " @isset($required) required @endisset>
        <option value="">@lang('site.customers')</option>
        @foreach ($customers as $value)
            <option value="{{ $value->id }}" @if (old('customer_id', request('customer_id')) == $value->id) selected @endif>{{ $value->full_name }}</option>
        @endforeach
    </select>
</div>
