<x-layout>
    <h2>Trashed Categories</h2>

    <ul>
        @foreach($categories as $category)
            <li>
                {{ $category->name }} - Deleted at: {{ $category->deleted_at }}
                <form method="POST" action="{{ route('categories.restore', ['category' => $category->id]) }}">
                    @csrf
                    <button type="submit">Restore</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>