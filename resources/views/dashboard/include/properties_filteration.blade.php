<div class = 'container'>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class= 'row'>

                <div class= 'col-md-4'>
                    <div class="form-group">
                        <label>@lang('site.teachers')</label>
                        <select name='teacher_id' class="form-control"  >
                            <option value="">@lang('site.teachers')</option>
                            @foreach( $teachers as $item )
                            <option value="{{ $item->id}}" @if( request('teacher_id') == $item->id ) selected  @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
