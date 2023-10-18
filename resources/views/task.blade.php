<ul>
    <li class="w-screen">
        {{ $task['title'] }}
    </li>
    <li>
        {{ $task['content'] }}
    </li>
    <hr/>
    <br>
    <li class="flex">
        <a href="{{ route('tasks.index') }}" class="btn btn-blue">Back</a>
{{--        <a href="{{ route('post.edit', $task['id']) }}" class="btn btn-blue">Edit</a>--}}
        <form
{{--            action="{{ route('task.delete', $task['id']) }}"--}}
            method="POST"
        >
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-blue cursor-pointer">
        </form>
    </li>
</ul>
