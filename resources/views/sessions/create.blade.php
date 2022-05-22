<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center text-bold text-xl">Login</h1>
                <form method="POST" action="/sessions" class="mt-8">
                    @csrf
                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="password" type="password" autocomplete="new-password"/>

                    <x-form.button>Login</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
