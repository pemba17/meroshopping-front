<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;

class SingleBlog extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.single-blog');
    }
}
