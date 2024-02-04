<div class="w-full bg-gray-200 px-4 py-2">
    <strong>{{ $comment->user->name }}:</strong>
    <p>{{ $comment->body }}</p>
    @auth
    @if(auth()->id() === $comment->user->id)
    <div class="flex space-x-4">
        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete </button>
        </form>
    </div>
    @endif
    @endauth
</div>