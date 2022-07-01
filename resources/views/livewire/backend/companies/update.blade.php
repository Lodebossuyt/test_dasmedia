<div>
    <input wire:model="name" type="text" id="Title"
           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg">
    @error('name') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
</div>
