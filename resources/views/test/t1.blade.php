<div>
    <ul>
        @foreach ($listShare['categories'] as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</div>
