<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
   use WithFileUploads;

   public $open = false;
   public $title;
   public $content;
   public $image;
   public $imageId;

   protected $rules = [
      'title'   => 'required|max:20',
      'content' => 'required|min:100',
      'image'   => 'required|image|max:2048'
   ];

   public function mount()
   {
      $this->imageId = rand(); // used to reset image path of input control.
   }

   public function updated($property) // runs each time a control is modified, remove "refer"
   {
      $this->validateOnly($property);
   }

   public function render()
   {
      return view('livewire.create-post');
   }

   public function save()
   {
      $this->validate();

      $image = $this->image->store('posts'); // saves in public/post directory

      Post::create([
         'title'   => $this->title,
         'content' => $this->content,
         'image'   => $image
      ]);

      $this->reset(['open', 'title', 'content', 'image']);

      $this->mount();

      $this->emitTo('show-posts', 'renderPostList'); // wiill emit renderPostList only for show-posts component to listen.
      $this->emit('alertDialog', 'The post has been created successfully!');
   }
}
