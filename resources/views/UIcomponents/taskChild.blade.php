<ul class="category-child-list">
    @foreach($children as $child)
        <ul>
            @foreach($children as $child)
                <li>
                    <x-taskCard :task="@child"></x-taskCard>
                    @if(count($child['children']) > 0)
                        @include('UIcomponents.taskChildChild', ['children' => $child['children']])
                    @endif
                </li>
            @endforeach
        </ul>
    @endforeach
</ul>
