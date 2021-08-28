@foreach ($childs as $child)

    <div class="collapse-mega">
        <div class="mega-box">
            <h5>{{ $child->name }} <span class="sub-arrow"></span>
            </h5>

            @if (count($child->childs))
                <ul>
                    @include('frontend.components.app.manageChild',['childs' => $child->childs])
                </ul>
            @endif

        </div>
    </div>

@endforeach
