<div>
    <div class="flex items-center">
        <h2 class="text-2xl font-bold mx-2">Vacatures</h2>
        <button wire:click="createVacatureModal"
                class="bg-green-400 hover:bg-green-500 rounded-md transition px-4 py-2 mr-2">Create Vacature
        </button>
        <button wire:click="createCompanyModal"
                class="bg-green-400 hover:bg-green-500 rounded-md transition px-4 py-2 mr-2">Manage Companies
        </button>
        <button wire:click="export"
                class="bg-yellow-400 hover:bg-yellow-500 rounded-md transition px-4 py-2 mr-2">Download CSV
        </button>
    </div>
    <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <form>
                    <label for="">
                        Search Title:
                        <input wire:model="title" type="text">
                    </label>
                </form>
            </div>
        </div>
    </div>

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
                    <th class="px-4 py-3">Actions</th>
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
                        <td class="px-4 py-3 text-sm">
                            <div class="flex">
                                <button wire:click="editVacatureModal({{$vacature->id}})" type="button"
                                        class="mr-2 flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide capitalize transition-colors duration-200 transform bg-yellow-500 rounded-md dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:bg-yellow-700 hover:bg-yellow-600 focus:outline-none focus:bg-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button wire:click="deleteVacatureModal({{$vacature->id}})" type="button"
                                        class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-700 hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$vacatures->render()}}
        </div>

        <x-small-modal wire:model="showVacatureDeleteModal">
            <x-slot name="title">
                <p>Detail: {{$currentVacature->title}}</p>
            </x-slot>
            <x-slot name="body">
                Are you sure you want to delete this vacature?
            </x-slot>
            <x-slot name="footer">
                <button @click="show = false"
                        class="bg-gray-400 hover:bg-gray-500 rounded-md transition px-4 py-2 mr-2">
                    Cancel
                </button>
                <button wire:click="deleteVacature({{$currentVacature->id}})"
                        class="bg-red-400 hover:bg-red-500 rounded-md transition px-4 py-2 mr-2">
                    Delete
                </button>
            </x-slot>
        </x-small-modal>

        <x-big-modal wire:model="showVacatureModal">
            <x-slot name="title">
                @if($isUpdate)
                    <p>Update Vacature</p>
                @else
                    <p>Create Vacature</p>
                @endif
            </x-slot>
            <x-slot name="body">
                <div class="col-span-6 sm:col-span-3 mb-4">
                    <label for="Title" class="block text-sm font-medium text-gray-700">Title:</label>
                    <input wire:model="name" type="text" id="Title"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('name') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-6 sm:col-span-3 mb-4">
                    <label for="Company" class="block text-sm font-medium text-gray-700">Company:</label>
                    <select wire:model="company" id="Company"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                    @error('company') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-6 sm:col-span-3 mb-4">
                    <label for="apply" class="block text-sm font-medium text-gray-700">Apply:</label>
                    <select wire:model="apply" id="apply"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="0">apply later...</option>
                        <option value="1">spontaneously apply for a job!</option>
                    </select>
                    @error('apply') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-6 sm:col-span-3 mb-4">
                    <label for="label" class="block text-sm font-medium text-gray-700">Label:</label>
                    <select wire:model="label" id="label"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="0">unimportant</option>
                        <option value="1">important</option>
                    </select>
                    @error('label') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                <button @click="show = false"
                        class="bg-gray-400 hover:bg-gray-500 rounded-md transition px-4 py-2 mr-2">
                    Cancel
                </button>
                @if($isUpdate)
                    <button wire:click="editVacature"
                            class="bg-green-400 hover:bg-green-500 rounded-md transition px-4 py-2 mr-2">
                        Update
                    </button>
                @else
                    <button wire:click="createVacature"
                            class="bg-green-400 hover:bg-green-500 rounded-md transition px-4 py-2 mr-2">
                        Create
                    </button>
                @endif
            </x-slot>
        </x-big-modal>

        <x-big-modal wire:model="showCompanyModal">
            <x-slot name="title">
                Manage companies
            </x-slot>
            <x-slot name="body">
                @livewire('backend.companies.index')
            </x-slot>
            <x-slot name="footer">
                <button @click="show = false"
                        class="bg-gray-400 hover:bg-gray-500 rounded-md transition px-4 py-2 mr-2">
                    Cancel
                </button>
            </x-slot>
        </x-big-modal>


    </div>
</div>
