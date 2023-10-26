<ul id="hexGrid">
    @foreach($tags as $tag)
    <li class="hex">
        <button class="hexIn">
            {{$tag['name']}}
        </button>
    </li>
    @endforeach
</ul>
