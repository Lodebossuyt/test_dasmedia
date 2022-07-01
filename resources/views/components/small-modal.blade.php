<div
    x-data="{show: @entangle($attributes->wire('model'))}"
    x-show="show"
    @keydown.escape.window="show = false"
    style="display:none;"
>
    <div class="fixed inset-0 bg-gray-900/80 z-20">
        <div class="bg-white/100 shadow-lg max-w-sm h-64 m-auto rounded-md fixed inset-0 z-30"
             x-show="show"
             x-transition
             @click.away="show = false"
        >
            <div class="flex flex-col h-full justify-between">

                <header class="p-6">
                    <h3 class="font-bold text-lg">
                        {{$title}}
                    </h3>
                </header>

                <main class="mb-4 px-6">
                    <p>
                        {{$body}}
                    </p>
                </main>

                <footer class="flex flex-end rounded-b-md px-6 py-4 mt-6 bg-gray-200">
                    {{$footer}}
                </footer>

            </div>
        </div>
    </div>
</div>
