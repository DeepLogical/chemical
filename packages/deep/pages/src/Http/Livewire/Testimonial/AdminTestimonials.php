<?php

namespace Deep\Pages\Http\Livewire\Testimonial;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Testimonial;
use Livewire\WithPagination;

class AdminTestimonials extends Component
{
    use WithPagination;

    public $perPage = 100, $search, $counter = 0;

    public function render(){
        $data =   Testimonial::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.testimonial.admin-testimonials', ["data" => $data])->layout('layouts.admin');
    }

    public function changeStatus($id, $status){
        $message = changeStatus('testimonials', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message ]);
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled', 'testimonialModalUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->dispatch('openTestimonialModal'); }
    public function testimonialModalUpdated(){ $this->counter++; }
}