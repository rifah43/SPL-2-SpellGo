<ul>
    @foreach($levels as $level)
        <li>
            <input type="checkbox" {{ $level->progress ? 'checked' : '' }}>
            {{ $level->name }}
        </li>
    @endforeach
</ul>
