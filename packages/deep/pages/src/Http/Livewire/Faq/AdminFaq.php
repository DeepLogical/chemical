<?php

namespace Deep\Pages\Http\Livewire\Faq;

use Livewire\Component;

use Deep\Pages\Models\Faq;
use Livewire\WithPagination;

class AdminFaq extends Component
{
    use WithPagination;
    public $perPage = 50, $search, $counter = 0;

    public function render(){
        $data =   Faq::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.faq.admin-faq', ["data" => $data])->layout('layouts.admin');
    }

    public function changeStatus($id, $status){
        $message = changeStatus('faqs', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message ]);
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled', 'faqModalUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->dispatch('openFaqModal'); }
    public function faqModalUpdated(){ $this->counter++; }
}
