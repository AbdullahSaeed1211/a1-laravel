<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Mongo\BlogPost;
use Livewire\Component;

class Edit extends Component
{
    public $postId;

    public $title;

    public $title_es;

    public $slug;

    public $author;

    public $excerpt;

    public $excerpt_es;

    public $coverImage;

    public $published;

    public function mount($id)
    {
        $post = BlogPost::find($id);
        if (! $post) {
            abort(404);
        }

        $this->postId = $post->_id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->author = $post->author;
        $this->excerpt = $post->excerpt ?? '';
        $this->coverImage = $post->coverImage ?? '';
        $this->published = $post->published ?? false;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $post = BlogPost::find($this->postId);
        if ($post) {
            $post->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'author' => $this->author,
                'excerpt' => $this->excerpt,
                'coverImage' => $this->coverImage,
                'published' => $this->published,
            ]);
        }

        session()->flash('message', 'Blog post updated successfully.');

        return redirect()->route('admin.blogs.index');
    }

    public function render()
    {
        return view('livewire.admin.blog.edit')
            ->layout('layouts.admin');
    }
}
