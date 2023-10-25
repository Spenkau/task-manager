<ul class="child task-child-list disabled">
    @foreach($children as $child)
        <li class="child-item">
            <x-taskCard :task="$child"></x-taskCard>
            @if(count($child['children']) > 0)
                @include('UIcomponents.taskChild', ['children' => $child['children']])
            @endif
        </li>
    @endforeach
</ul>
