<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;

use Auth;

class AdminHeader extends Component
{
    public $search, $showSearch, $data = [], $notificationCount= 0, $counter = 0;

    public function mount(){
        $this->data = getAdminLinks();
        $this->getNotificationCount();
    }

    public function render(){ return view('deep::livewire.parts.admin-header'); }

    public function searchClicked(){
        $this->showSearch               =   1;

        if( !$this->search ){
            return;
        }

        $this->dispatch('searchUpdated', $this->search);
    }

    private function getNotificationCount(){
        if(Auth::check()){
            $this->notificationCount = count( Auth::user()->unreadNotifications );            
        }
        $this->counter++;
    }

    public function userRegistered(){ $this->counter++; }
}