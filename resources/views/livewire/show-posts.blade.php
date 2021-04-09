<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
   {{-- {{ $search }} --}}
   <x-table>
      <div class="py-4 px-6">
         {{-- <input type="text" wire:model="search"> --}}
         <x-jet-input type="text" class="w-full" placeholder="Enter text to search" wire:model="search" />
      </div>

      @if ($posts->count())
         <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
               <tr>
                  <th scope="col"
                     class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
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
               @foreach ($posts as $post)
                  <tr>
                     <td class="px-6 py-4">
                        <div class="text-sm text-gray-900"> {{ $post->id }} </div>
                     </td>
                     <td class="px-6 py-4">
                        <span
                           class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                           {{ $post->title }}
                        </span>
                     </td>
                     <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $post->content }}
                     </td>
                     <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
   </x-table>
</div>
