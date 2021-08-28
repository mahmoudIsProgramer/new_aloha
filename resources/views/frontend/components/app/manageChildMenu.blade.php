@foreach ($childs as $child)
    <ul>
        <li>
            <a href="javascript:void(0)">{{ $child->name }}
            </a>
            <ul>
                @include('frontend.components.app.manageChildMenu',['childs' => $child->childs])
            </ul>
        </li>
    </ul>
@endforeach
