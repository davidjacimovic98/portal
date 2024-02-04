<x-layout>
        <a href="/" class="inline-block text-black ml-4 mb-4"
            ><i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div class="mx-4">
            <div class="!p-10">
                <div
                    class="flex flex-col items-center justify-center text-center"
                >
                    <img
                        class="mr-6 mb-6"
                        src="{{$news->logo ? asset('storage/' . $news->logo) : asset('images/portal-no-image.jpg')}}"
                        alt="image"
                    />
    
                    <h3 class="text-2xl mb-2">{{$news->title}}</h3>
                    <x-news-tags :newsTags="$news->tags" />
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <h3 class="text-3xl font-bold mb-4">
                            News description
                        </h3>
                        <div class="text-lg space-y-6">
                            {{$news->description}}
                        </div>
                    </div>  
                </div>
                {{-- comments --}}
                <div class="mt-9">
                    <h3 class="text-xl font-bold mb-4">
                        Comments
                    </h3>
                    <div class="text-lg space-y-6">
                        @auth
                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="news_id" value="{{ $news->id }}">
                            <textarea class="w-full" name="body" placeholder="Add your comment here" required></textarea>
                            <br>
                            <button class="text-sm text-white rounded py-2 px-4 bg-gray-400 hover:bg-black" type="submit">Submit comment</button>
                        </form>
                        @else
                            <p>Please login to add a comment.</p>
                        @endauth
                        @foreach ($news->comments as $comment)
                            <x-comment-card :comment="$comment" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-layout>