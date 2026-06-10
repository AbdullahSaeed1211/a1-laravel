<?php

namespace App\Livewire\Admin\Seo;

use App\Models\Mongo\PageSEO;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $editingId = null;

    public $editTitle = '';

    public $editTitleEs = '';

    public $editDescription = '';

    public $editDescriptionEs = '';

    public function edit($id)
    {
        $seo = PageSEO::find($id);
        if ($seo) {
            $this->editingId = $seo->_id;
            $this->editTitle = $seo->title ?? '';
            $this->editTitleEs = $seo->title_es ?? '';
            $this->editDescription = $seo->description ?? '';
            $this->editDescriptionEs = $seo->description_es ?? '';
        }
    }

    public function save()
    {
        $seo = PageSEO::find($this->editingId);
        if ($seo) {
            $seo->update([
                'title' => $this->editTitle,
                'title_es' => $this->editTitleEs,
                'description' => $this->editDescription,
                'description_es' => $this->editDescriptionEs,
            ]);
        }

        $this->editingId = null;
        session()->flash('message', 'SEO entry updated.');
    }

    public function cancel()
    {
        $this->editingId = null;
    }

    public function render()
    {
        $seoEntries = PageSEO::orderBy('slug')->paginate(20);

        return view('livewire.admin.seo.index', [
            'seoEntries' => $seoEntries,
        ])->layout('layouts.admin');
    }
}
