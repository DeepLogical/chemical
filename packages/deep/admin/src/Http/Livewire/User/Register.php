<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

class Register extends Component
{
    public function render(){ return view('deep::livewire.user.register')->layout('layouts.guest'); }
}