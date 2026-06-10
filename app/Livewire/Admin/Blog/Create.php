<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Mongo\BlogPost;
use Livewire\Component;
use MongoDB\BSON\ObjectId;

class Create extends Component
{
    public $title = '';

    public $title_es = '';

    public $slug = '';

    public $author = '';

    public $excerpt = '';

    public $excerpt_es = '';

    public $coverImage = '';

    public $published = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:blogs,slug',
        'author' => 'nullable|string|max:255',
        'excerpt' => 'nullable|string',
        'coverImage' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        BlogPost::create([
            '_id' => (string) new ObjectId,
            'title' => $this->title,
            'slug' => $this->slug,
            'author' => $this->author,
            'excerpt' => $this->excerpt,
            'coverImage' => $this->coverImage,
            'published' => $this->published,
            'language' => 'en',
        ]);

        session()->flash('message', 'Blog post created successfully.');

        return redirect()->route('admin.blogs.index');
    }

    public function render()
    {
        return view('livewire.admin.blog.create')
            ->layout('layouts.admin');
    }
}
