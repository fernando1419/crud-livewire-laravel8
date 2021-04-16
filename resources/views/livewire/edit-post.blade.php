<div>
   <a class="font-bold text-white py-2 px-3 rounded cursor-pointer bg-green-600 hover:bg-green-500"
      wire:click="$set('open', true)">
      <i class="fas fa-edit"></i>
   </a>

   <x-jet-dialog-modal wire:model="open">
      <x-slot name='title'>
         Editing post: {{ $post->title }}
      </x-slot>
      
      <x-slot name='content'>

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
         @else
            <img src="{{ Storage::url($post->image) }}" />
         @endif

         <div class="mb-4">
            <x-jet-label value="Post title"></x-jet-label>
            <x-jet-input wire:model="post.title" type="text" class="w-full"></x-jet-input>
         </div>
         
         <div class="mb-4">
            <x-jet-label value="Post content"></x-jet-label>
            <textarea wire:model="post.content" rows="5" class="form-control w-full"></textarea>
         </div>

         <div>
            <input type="file" name="image" wire:model="image" id="{{ $imageId }}">
            <x-jet-input-error for="image" />
         </div>
      </x-slot>

      <x-slot name='footer'>
         <x-jet-secondary-button wire:click="$set('open', false)"> Cancel </x-jet-secondary-button>
         <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25"> 
            Update 
         </x-jet-danger-button>
      </x-slot>
   </x-jet-dialog-modal>
</div>
