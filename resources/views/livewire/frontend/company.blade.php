<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Frontend vacatures') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                        <div class="overflow-x-auto w-full">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                                    <th class="px-4 py-3">Id</th>
                                    <th class="px-4 py-3">Title</th>
                                    <th class="px-4 py-3">Company</th>
                                    <th class="px-4 py-3">Apply</th>
                                    <th class="px-4 py-3">label</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y">
                                @foreach($vacatures as $vacature)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $vacature->id }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $vacature->title }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{route('company', $vacature->company->id)}}">
                                                {{ $vacature->company->name }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($vacature->apply)
                                                <x-badge class="bg-violet-400 hover:bg-violet-500">
                                                    Apply spontaneously!
                                                </x-badge>
                                            @else
                                                <x-badge class="bg-red-400 hover:bg-red-500">apply later...</x-badge>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($vacature->label)
                                                <x-badge class="bg-indigo-400 hover:bg-indigo-500">important</x-badge>
                                            @else
                                                <x-badge class="bg-amber-400 hover:bg-amber-500">unimportant</x-badge>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$vacatures->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
