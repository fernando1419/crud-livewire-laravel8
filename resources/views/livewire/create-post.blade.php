<div>
   <x-jet-danger-button wire:click="$set('open', true)">
      Create Post
   </x-jet-danger-button>

   <x-jet-dialog-modal wire:model="open">

      <x-slot name="title">Create new Post</x-slot>

      <x-slot name="content">

         <!-- Link on the right -->
         <div wire:loading wire:target="image"
            class="mb-4 space-x-2 bg-blue-50 p-4 rounded flex items-start text-blue-600 my-4 shadow-lg mx-auto w-full">
            {{-- <div class=""> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
               <path
                  d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.5 5h3l-1 10h-1l-1-10zm1.5 14.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
            </svg>
            {{-- </div> --}}
            <h4 class="text-blue-800 tracking-wider flex-1">
               Uploading your image, please wait...
            </h4>
         </div>

         @if ($image)
            <img class="mb-4" src="{{ $image->temporaryUrl() }}" />
         @endif

         <div class="mb-4">
            <x-jet-label value="Post title" />
            <x-jet-input type="text" class="w-full" wire:model="title" />
            <x-jet-input-error for="title" />
         </div>
         <div class="mb-4">
            <x-jet-label value="Post Content" />
            <textarea rows="5"
               class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
               wire:model="content">
            </textarea>
            <x-jet-input-error for="content" />
         </div>

         <div>
            <input type="file" name="image" wire:model="image" id="{{ $imageId }}">
            <x-jet-input-error for="image" />
         </div>

      </x-slot>

      <x-slot name="footer">
         <x-jet-secondary-button wire:click="$set('open', false)">Cancel</x-jet-secondary-button>
         <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image">
            Create
         </x-jet-danger-button>
         {{-- <span wire:loading wire:target="save">Saving...</span> --}}
      </x-slot>
   </x-jet-dialog-modal>
</div>
