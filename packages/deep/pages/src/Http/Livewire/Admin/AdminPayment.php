<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Payment;

class AdminPayment extends Component
{
    public $perPage = 100;
    public $search;

    public function render(){
        $data =   Payment::with('user:id,name')->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-payment', [ 'data' => $data ] )->layout('layouts.admin');
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated'];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}