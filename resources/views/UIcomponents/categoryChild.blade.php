<ul class="category-child-list">
    @foreach($children as $child)
        <ul>
            @foreach($children as $child)
                <li>
                    <button>
                        <i class="icon-category">иконка дома</i>
                        {{ $child['name'] }}
                    </button>
                    @if(count($child['children']) > 0)
                        @include('UIcomponents.categoryChild', ['children' => $child['children']])
                    @endif
                </li>
            @endforeach
        </ul>
    @endforeach
</ul>
