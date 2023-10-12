<ul>
    @foreach($children as $child)
        <ul>
            @foreach($children as $child)
                <li>
                    <button>
                        <i>иконка дома</i>
                        {{ $child->name }}
                    </button>
                    @if($child->children->count() > 0)
                        @include('categories.child', ['children' => $child->children])
                    @endif
                </li>
            @endforeach
        </ul>
    @endforeach
</ul>
