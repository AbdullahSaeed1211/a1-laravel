<?php

namespace App\Livewire\Admin\Blog;

use App\Models\Mongo\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'createdAt';

    public $sortDirection = 'desc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function delete($id)
    {
        $post = BlogPost::find($id);
        if ($post) {
            $post->delete();
            session()->flash('message', 'Blog post deleted.');
        }
    }

    public function render()
    {
        $query = BlogPost::query();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        $blogs = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        return view('livewire.admin.blog.index', [
            'blogs' => $blogs,
        ])->layout('layouts.admin');
    }
}
