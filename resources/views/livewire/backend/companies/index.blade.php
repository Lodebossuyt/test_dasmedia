<div>
    <label for="Title" class="block text-sm font-medium text-gray-700">Company Name:</label>
    <div class="flex">
        <input wire:model="name" type="text" id="Title"
               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-l-lg">
        <button wire:click="createCompany" class="bg-indigo-400 hover:bg-indigo-500 rounded-r-lg block">Create company</button>
    </div>
    <div>
        @error('name') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
    </div>
    <button wire:click="$emit('updateCompany')" class="bg-blue-400 hover:bg-blue-500 rounded-md transition px-4 py-2 mr-2 text-white font-bold mt-2">
        Update All
    </button>
    <table class="w-full whitespace-no-wrap mt-4">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3">Id</th>
            <th class="px-4 py-3">
                Name (click on the name to update)
            </th>
            <th class="px-4 py-3">Delete</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y">
        @foreach($companies as $company)
            <tr x-data="{showUpdate : false}" class="text-gray-700" @click.away="showUpdate = false">
                <td class="px-4 py-3 text-sm">
                    {{ $company->id }}
                </td>
                <td class="px-4 py-3 text-sm">
                    <div @click="showUpdate = true" x-show="!showUpdate">
                        {{$company->name}}
                    </div>
                    <div x-show="showUpdate">
                        @livewire('backend.companies.update', ['company'=>$company], key($company->id))
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">
                    <div class="flex">
                        <button wire:click="deleteCompany({{$company->id}})" type="button"
                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-700 hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                            <span>delete</span>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$companies->render()}}
</div>
