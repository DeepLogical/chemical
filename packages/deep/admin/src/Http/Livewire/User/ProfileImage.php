<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

use Auth;

class ProfileImage extends Component
{
    public $model_id;

    public function mount( $id = null ){
        $this->model_id         =   $id ? decode( $id ) : Auth::user()->id;         
    }
    
    public function render(){ return view('deep::livewire.user.profile-image')->layout('layouts.admin'); }
}