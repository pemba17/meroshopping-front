<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $blogs=Blog::where('blog_status',1)->paginate(10);
        return view('livewire.blogs',compact('blogs'));
    }
}
