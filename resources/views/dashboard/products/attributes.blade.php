{{-- @if ($value->color)
    @lang('site.color'): {{ $value->color->title }}
@endif
@if ($value->size)
    @lang('site.size'): {{ $value->size->title }}
@endif
@if ($value->material)
    @lang('site.material'): {{ $value->material->title }}
@endif
@if ($value->ram)
    @lang('site.ram'): {{ $value->ram->title }}
@endif
@if ($value->capacity)
    @lang('site.capacity'): {{ $value->capacity->title }}
@endif
@if ($value->sim)
    @lang('site.sim'): {{ $value->sim->title }}
@endif
@if ($value->type)
    @lang('site.type'): {{ $value->type->title }}
@endif --}}

@php $attributes = ['color','size','ram','capacity','sim','material','type'] @endphp
@foreach ($attributes as $att)
    @if ($value->$att)
        @lang('site.'.$att): {{ $value->$att->title }} <br>
    @endif
@endforeach
