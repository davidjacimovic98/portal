<x-layout>
    <div class="p-10 max-w-lg mx-auto mt-24 border">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-5">
                Edit {{$news->title}}
            </h2>
        </header>

        <form method="POST" action="{{route('news.update', $news)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">News title</label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="title"
                        placeholder="Example: USA elections in 2024"
                        value="{{$news->title}}"
                    />
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="inline-block text-lg mb-2">Category</label>
                <div>
                    @foreach($categories as $c)
                        <label class="inline-block mr-3">
                            <input type="radio" name="category_id" value="{{ $c->id }}" {{ $news->category_id == $c->id ? 'checked' : '' }}>
                            {{ $c->name }}
                        </label>
                    @endforeach
                </div>
            </div> 

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">Tags</label>
                <div>
                    @foreach($tags as $tag)
                        <label class="inline-block mr-3">
                            <input type="checkbox" name="existing_tags[]" value="{{ $tag->id }}" {{ in_array($tag->name, $existingTagIds) ? 'checked' : ''}}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>            

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    News image
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />
            </div>

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    News description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                >{{$news->description}}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="text-white rounded py-2 px-4 bg-gray-400 hover:bg-black"
                >
                    Update news
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </div>
</x-layout>