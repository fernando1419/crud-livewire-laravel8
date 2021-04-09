<div>
   <x-jet-danger-button wire:click="$set('open', true)">
      Create Post
   </x-jet-danger-button>

   <x-jet-dialog-modal wire:model="open">

      <x-slot name="title">Create new Post</x-slot>

      <x-slot name="content">
         <div class="mb-4">
            <x-jet-label value="Post title" />
            <x-jet-input type="text" class="w-full" wire:model.defer="title" />
            {{ $title }}
         </div>
         <div class="mb-4">
            <x-jet-label value="Post Content" />
            <textarea
               class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
               wire:model.defer="content">
            </textarea>
            {{ $content }}
         </div>
      </x-slot>

      <x-slot name="footer">
         <x-jet-secondary-button wire:click="$set('open', false)">Cancel</x-jet-secondary-button>
         <x-jet-danger-button wire:click="save">Create</x-jet-danger-button>
      </x-slot>
   </x-jet-dialog-modal>
</div>
