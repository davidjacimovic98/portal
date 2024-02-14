<x-layout>
    <div class="!p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Trashed news
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($trashed_news->isEmpty())
                @foreach($trashed_news as $n)
                <tr class="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="/news/{{$n->id}}">
                            {{$n->title}}
                        </a>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                    <form method="POST" action="{{ route('news.restore', $n->id) }}">
                        @csrf
                        <button type="submit" class="text-blue-400 px-6 py-2 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i> Restore
                        </button>
                    </form>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                    <form method="POST" action="{{route('news.forceDelete', $n->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Force delete </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No news found</p>
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
    </div>
</x-layout>