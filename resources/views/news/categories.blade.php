<x-layout>
    <a href="{{route('categories.trashed')}}">-> Click here to see trashed categories</a>

    <ul>
        @foreach($categories as $category)
            <li><a href="{{ route('news.category.news', $category) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</x-layout>