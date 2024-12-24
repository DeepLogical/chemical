<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Pages\Models\Contact;
use Livewire\WithPagination;

class AdminContact extends Component
{
    use WithPagination;
    
    public $perPage = 50;
    public $search;

    public function mount(){
        clearNotifications("/admin/contact");
        $this->dispatch('notificationRead');
    }

    public function render(){
        $data =   Contact::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-contact', ["data" => $data])->layout('layouts.admin');
    }
    
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}