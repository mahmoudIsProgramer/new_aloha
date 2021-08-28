{{-- models , key , required --}}
@if (isset($$model))
    <div class="form-group">
        <label>@lang('site.'.$model)</label>
        <select name='{{ $key }}' id='{{ $key }}' class="form-control selectpicker"
            data-live-search="true" $required>
            <option value="">@lang('site.'.$model)</option>
            @foreach ($$model as $item)
                <option value="{{ $item->id }}" @if (old($key, $product->$key ?? null) == $item->id) selected @endif>
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
    </div>
@endif
