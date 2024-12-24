<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;
use Auth;

class AdminSidebar extends Component
{
    public $show = false, $data = [];

    public function mount(){        
        $this->data = getAdminLinks();
    }

    public function render(){ return view('deep::livewire.parts.admin-sidebar')->layout('layouts.admin'); }

    protected $listeners = ['toggleAdminSidebar'];
    public function toggleAdminSidebar(){
        $this->show         = !$this->show;
    }
}