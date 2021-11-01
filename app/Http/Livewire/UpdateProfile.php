<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $user_id,$name,$address,$contact,$photo;

    public function mount(){
        $user=User::find(auth()->user()->id);
        $this->user_id=$user->id;
        $this->name=$user->name;
        $this->address=$user->address;
        $this->contact=$user->contact;
    }
    public function render()
    {
        return view('livewire.update-profile');
    }

    public function save(){
        $this->validate([
            'name'=>['required','string','max:100'],
            'address'=>['nullable','string','max:50'],
            'contact'=>['required','numeric','digits_between:7,10',Rule::unique('clients')->ignore($this->user_id)],
            'photo'=>['nullable','image']

        ]);
        if($this->photo==null){
            $filepath=auth()->user()->photo;
        }else{
            $filename=$this->photo->store('/','user_image');
            $filepath=Storage::disk('user_image')->url($filename);
        }
        User::where('id',$this->user_id)
              ->update([
                'name'=>$this->name,
                'address'=>$this->address,
                'contact'=>$this->contact,
                'photo'=>$filepath
        ]);
        
        session()->flash('success','Profile Updated Successfully');
    }
}
