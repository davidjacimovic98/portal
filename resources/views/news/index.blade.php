<x-layout>
    <form action="/">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="search"
                class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search news..."
            />
            <div class="absolute top-2 right-2">
                <button
                    type="submit"
                    class="h-10 w-20 text-white rounded-lg bg-gray-500 hover:bg-black"
                >
                    Search
                </button>
            </div>
        </div>
    </form>
    
    <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($news) === 0)
            <p>There are no any news.</p>
        @endif

        @foreach($news as $n)
            <x-news-card :news="$n" />
        @endforeach
    </div>

    <div class="mt-6 p-4">
        {{$news->links()}}
    </div>
</x-layout>