@props(['comment'])
<x-panel class="bg-gray-200">
    <artical class="flex space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" width="60" height="60" class="rounded-xl">
        </div>
        <div>
            <header>
                <h3 class="font-bold">{{ $comment->author->username }}</h3>

                <p class="text-xs mb-4">
                    Posted
                    <time>{{ $comment->created_at->format('F j, Y, g:i, a')}}</time>{{--diffForHumans()--}}
                </p>
            </header>
            <p>
                {{ $comment->body }}
            </p>
        </div>
    </artical>
</x-panel>
