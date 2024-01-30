<x-layout>
    <div class="!p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage news
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($news->isEmpty())
                @foreach($news as $news)
                <tr class="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="/news/{{$news->id}}">
                            {{$news->title}}
                        </a>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a
                            href="/news/{{$news->id}}/edit"
                            class="text-blue-400 px-6 py-2 rounded-xl"
                            ><i
                                class="fa-solid fa-pen-to-square"
                            ></i>
                            Edit</a
                        >
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                    <form method="POST" action="{{route('news.destroy')}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete </button>
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