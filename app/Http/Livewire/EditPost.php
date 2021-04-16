<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
	use WithFileUploads;

	public $post;
	public $open = false;
	public $image;
	public $imageId;

	protected $rules = [
		'post.title'   => 'required',
		'post.content' => 'required'
	];

	public function mount(Post $post)
	{
		$this->post    = $post;
		$this->imageId = rand(); // used to reset image path of input control.
	}

	public function render()
	{
		return view('livewire.edit-post');
	}

	public function save()
	{
		$this->validate();

		if ($this->image) { // if selected image.
			Storage::delete([$this->post->image]);

			$this->post->image = $this->image->store('posts');
		}

		$this->post->save();

		$this->reset(['open', 'image']);

		$this->imageId = rand(); // used to reset image path of input control.

		$this->emitTo('show-posts', 'renderPostList'); // will emit renderPostList only for show-posts component to listen.

		$this->emit('alertDialog', 'The post has been updated successfully!');
	}
}
