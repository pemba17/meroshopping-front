<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ticket as Tickets;

class Ticket extends Component
{
    public $title,$description;
    public function render()
    {
        return view('livewire.ticket');
    }

    public function save(){
        $arr=$this->validate([
            'title'=>['required','string','max:100'],
            'description'=>['required','string','max:300']
        ]);
        
        Tickets::create([
            'title'=>$this->title,
            'description'=>$this->description,
            'client_id'=>auth()->user()->id
        ]);
        session()->flash('success','Ticket Open Successfully');
        $this->reset();
    }
}
