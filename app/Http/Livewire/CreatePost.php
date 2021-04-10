<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
   public $open = false;
   public $title;
   public $content;

   protected $rules = [
      'title'   => 'required|max:20',
      'content' => 'required|min:100'
   ];

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

      Post::create([
         'title'   => $this->title,
         'content' => $this->content
      ]);

      $this->reset(['open', 'title', 'content']);

      $this->emitTo('show-posts', 'renderPostList'); // wiill emit renderPostList only for show-posts component to listen.
      $this->emit('alertDialog', 'The post has been created successfully!');
   }
}
