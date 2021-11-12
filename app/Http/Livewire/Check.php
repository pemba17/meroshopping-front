<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Check extends Component
{
    public function render()
    {
        $categories=Category::whereNull('parentId')->get();
        return view('livewire.check',compact('categories'));
    }
}
