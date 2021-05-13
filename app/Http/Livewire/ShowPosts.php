<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
   use WithFileUploads, WithPagination;

   public $search    = '';
   public $sort      = 'id';
   public $direction = 'desc';
   public $post;
   public $open_edit = false;
   public $image;
   public $imageId;
   public $quantity  = '10';
   public $isLoading = false;

   protected $queryString = [
      'quantity'  => ['except' => '10'],
      'sort'      => ['except' => 'id'],
      'direction' => ['except' => 'desc'],
      'search'    => ['except' => '']
   ];

   protected $rules = [
      'post.title'   => 'required',
      'post.content' => 'required'
   ];

   protected $listeners = ['renderPostList' => 'render'];

   public function mount()
   {
      $this->imageId = rand(); // used to reset image path of input control.
      $this->post    = new Post();
   }

   public function updatingSearch()
   {
      $this->resetPage();
   }

   public function loadPosts()
   {
      $this->isLoading = true;
   }

   public function render()
   {
      if ($this->isLoading) {
         $posts = Post::where('title', 'like', '%' . $this->search . '%')
      ->orWhere('content', 'like', '%' . $this->search . '%')
      ->orderBy($this->sort, $this->direction)
      ->paginate($this->quantity);
      } else {
         $posts = [];
      }

      return view('livewire.show-posts', compact('posts'));
   }

   public function order($sortField)
   {
      if ($this->sort == $sortField) {
         if ($this->direction == 'desc') {
            $this->direction = 'asc';
         } else {
            $this->direction = 'desc';
         }
      } else {
         $this->sort      = $sortField;
         $this->direction = 'asc';
      }
   }

   public function edit(Post $post)
   {
      $this->post      = $post;
      $this->open_edit = true;
   }

   public function update()
   {
      $this->validate();

      if ($this->image) { // if selected image.
         Storage::delete([$this->post->image]);

         $this->post->image = $this->image->store('posts');
      }

      $this->post->save();

      $this->reset(['open_edit', 'image']);

      $this->imageId = rand(); // used to reset image path of input control.

      $this->emit('alertDialog', 'The post has been updated successfully!');
   }
}
