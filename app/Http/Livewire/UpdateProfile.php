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
    public $user_id,$name,$address,$contact,$photo,$phone,$dob,$gender,$country,$state,$city,$zip_code;

    public function mount(){
        $user=User::find(auth()->user()->id);
        $this->user_id=$user->id;
        $this->name=$user->name;
        $this->address=$user->address;
        $this->contact=$user->contact;
        $this->phone=$user->phone;
        $this->dob=$user->dob;
        $this->gender=$user->gender;
        $this->country=$user->country;
        $this->state=$user->state;
        $this->city=$user->city;
        $this->zip_code=$user->zip_code;
    }
    public function render()
    {
        return view('livewire.update-profile');
    }

    public function save(){
        $this->validate([
            'name'=>['required','string','max:100'],
            'address'=>['nullable','string','max:50'],
            'contact'=>['required','numeric','digits:10',Rule::unique('clients')->ignore($this->user_id)],
            'photo'=>['nullable','image'],
            'phone'=>['nullable','numeric','digits:7',Rule::unique('clients')->ignore($this->user_id)],
            'dob'=>['nullable','date'],
            'gender'=>['nullable','string','max:20'],
            'country'=>['nullable','string','max:50'],
            'state'=>['nullable','string','max:50'],
            'city'=>['nullable','string','max:50'],
            'zip_code'=>['nullable','numeric','digits_between:1,10']
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
                'photo'=>$filepath,
                'phone'=>$this->phone,
                'dob'=>$this->dob,
                'gender'=>$this->gender,
                'country'=>$this->country,
                'state'=>$this->state,
                'city'=>$this->city,
                'zip_code'=>($this->zip_code==null || $this->zip_code=="")?null:$this->zip_code
        ]);
        
        session()->flash('success','Profile Updated Successfully');
    }
}
