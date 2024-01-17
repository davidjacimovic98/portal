<x-layout>
    <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($news) === 0)
            <p>There are no any news.</p>
        @endif

        @foreach($news as $news)
            <x-news-card :news="$news" />
        @endforeach
    </div>

    <div class="mt-6 p-4">
        {{$news->links()}}
    </div>
</x-layout>