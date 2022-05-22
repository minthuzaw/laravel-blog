@auth
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="POST">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="60"
                     height="60" class="rounded-xl">

                <h2 class="ml-4">Want to participate?</h2>

            </header>
            <x-form.field>
                <x-form.cmt-textarea name="body"/>
                <x-form.error name="body"/>
            </x-form.field>
            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline" style="color: blue">Register </a>or
        <a href="/login" class="hover:underline" style="color: blue">Login</a> to leave a comments.
    </p>
@endauth
