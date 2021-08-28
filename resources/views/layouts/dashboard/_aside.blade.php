<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> {{ auth()->user()->first_name . auth()->user()->last_name }} </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">

            <li class=" @if ($page=='dashboard' ) active @endif ">
        <a href=" {{ route('dashboard.index') }}"><i
                    class="fa fa-dashboard"></i><span>@lang('site.dashboard')</span></a>
            </li>

            @php
                $modules = getModels();
                // dd($modules);
            @endphp


            @foreach ($modules as $item)

                @if (auth()->user()->hasPermission('read_' . $item))

                    <li class="@if ($page==$item) active @endif "><a href=" {{ route('dashboard.' . $item . '.index') }}"><i
                            class="fa fa-th"></i><span>{{ ucfirst(__('site.' . $item)) }} </span>

                        {{-- @include('layouts.dashboard.custome_link') --}}

                        </a></li>
                @endif

            @endforeach

            {{-- <li><a href="{{ route('dashboard.notifications.index') }}"><i
        class="fa fa-th"></i><span>@lang('site.notifications')</span></a></li> --}}



        </ul>
    </section>
</aside>
