
    <ul class="sidebar__list">
        @foreach($categories as $category)
            <li>
                <button>
                    <i class="icon-category"> иконка дома</i>
                    {{ $category['name'] }}
                </button>
                @if(count($category['children']) > 0)
                    @include('UIcomponents.categoryChild', ['children' => $category['children']])
                @endif
            </li>
        @endforeach
    </ul>

