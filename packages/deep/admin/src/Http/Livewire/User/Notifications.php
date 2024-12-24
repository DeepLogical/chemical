<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;
use Auth;

class Notifications extends Component
{
    public function mount(){
        foreach ( Auth::user()->notifications as $i) {
            $i->markAsRead();
        }
    }

    public function render(){
        return view('deep::livewire.user.notifications')->layout('layouts.admin');
    }
}