@props(['news'])

    <div class="flex-column mb-10">
        <img
            class="hidden mr-6 md:block"
            src="{{$news->logo ? asset('storage/' . $news->logo) : asset('images/portal-no-image.jpg')}}"
            alt="image"
        />
        <div>
            <h3 class="text-2xl">
                <a href="/news/{{$news->id}}">{{$news->title}}</a>
            </h3>

            <x-news-tags :newsTags="$news->tags" />
        </div>
    </div>