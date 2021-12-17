<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;

class StaticPage extends Component{

    public $page;

    public function mount(Request $request){
        $this->page=$request->route()->getName();
    }

    public function render(){
       if(view()->exists('livewire.static.'.$this->page)){
           return view('livewire.static.'.$this->page);
        }else{
           abort(404);
        } 
    }
}