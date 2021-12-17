<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;

class Contact extends Component
{
    public $name,$enquiry,$email,$contact;
    public function render()
    {
        return view('livewire.contact');
    }

    public function save(){
        $this->validate([
            'name'=>['required','string','max:20'],
            'contact'=>['required','numeric','digits:10'],
            'email'=>['required','email','max:20'],
            'enquiry'=>['required','string','max:300']
        ]);

        DB::table('contacts')
            ->insert([
                'name'=>$this->name,
                'enquiry'=>$this->enquiry,
                'email'=>$this->email,
                'contact'=>$this->contact,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        session()->flash('success','Form Submitted Successfully');
        $this->reset();
    }
}
