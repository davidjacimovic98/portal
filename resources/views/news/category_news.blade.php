<x-layout>
    <div class="flex justify-between">
        <h2>News for {{ $category->name }}:</h2>
        <form method="POST" action="{{ route('categories.softDelete', ['category' => $category->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Remove this category</button>
        </form>
    </div>
    <ul>
        @foreach($news as $item)
            <li><a href="/news/{{$item->id}}">{{ $item->title }}</a></li>
        @endforeach
    </ul>
</x-layout>
