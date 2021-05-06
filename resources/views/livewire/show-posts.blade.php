<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
   {{-- {{ $search }} --}}
   <x-table>
      <div class="py-4 px-6 flex items-center">
         {{-- <input type="text" wire:model="search"> --}}
         <div class="flex items-center">
            <span> Mostrar </span>
            <select wire:model="quantity" class="mx-2">
               <option value="10">10</option>
               <option value="25">25</option>
               <option value="50">50</option>
               <option value="100">100</option>
            </select>
            <span> Entradas </span>
         </div>
         <x-jet-input type="text" class="flex-1 mx-4" placeholder="Enter text to search" wire:model="search" />
         @livewire('create-post')
      </div>

      @if ($posts->count())
         <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
               <tr>
                  <th scope="col"
                     class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                     wire:click="order('id')">
                     ID
                     @if ($sort == 'id')
                        @if ($direction == 'asc')
                           <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                           <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                     @else
                        <i class="fas fa-sort float-right mt-1"></i>
                     @endif
                  </th>
                  <th scope="col"
                     class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                     wire:click="order('title')">
                     Title
                     @if ($sort == 'title')
                        @if ($direction == 'asc')
                           <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                           <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                     @else
                        <i class="fas fa-sort float-right mt-1"></i>
                     @endif
                  </th>
                  <th scope="col"
                     class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                     wire:click="order('content')">
                     Content
                     @if ($sort == 'content')
                        @if ($direction == 'asc')
                           <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                           <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                     @else
                        <i class="fas fa-sort float-right mt-1"></i>
                     @endif
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                     <span class="sr-only">Edit</span>
                  </th>
               </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
               @foreach ($posts as $item)
                  <tr>
                     <td class="px-6 py-4">
                        <div class="text-sm text-gray-900"> {{ $item->id }} </div>
                     </td>
                     <td class="px-6 py-4">
                        <span
                           class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                           {{ $item->title }}
                        </span>
                     </td>
                     <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $item->content }}
                     </td>
                     <td class="px-6 py-4 text-sm font-medium">
                        {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                        {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                        <a class="font-bold text-white py-2 px-3 rounded cursor-pointer bg-green-600 hover:bg-green-500"
                           wire:click="edit({{ $item }})">
                           <i class="fas fa-edit"></i>
                        </a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      @else
         <div class="py-4 px-6">
            No results for your search criteria.
         </div>
      @endif

      @if ($posts->hasPages())
         <div class="px-6 py-3">
            {{ $posts->links() }}
         </div>
      @endif
      
   </x-table>

   <x-jet-dialog-modal wire:model="open_edit">
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
         <x-jet-secondary-button wire:click="$set('open_edit', false)"> Cancel </x-jet-secondary-button>
         <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25"> 
            Update 
         </x-jet-danger-button>
      </x-slot>
   </x-jet-dialog-modal>
</div>
