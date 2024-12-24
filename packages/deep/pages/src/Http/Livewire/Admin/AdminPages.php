<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;

use Livewire\WithPagination;

class AdminPages extends Component
{
    use WithPagination;

    public $isOpen = 0, $perPage = 100, $search;

    public function render(){
        $data =   Pages::select([ 
                            'pages.*',
                            DB::raw('(SELECT COUNT(*) FROM testimonials WHERE testimonials.model_id = pages.id) as testisTotal'),
                            DB::raw('(SELECT COUNT(*) FROM faqs WHERE faqs.model_id = pages.id) as faqTotal')
                        ])
                         ->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-pages', [ "data" => $data ])->layout('layouts.admin');
    }

    protected $listeners = [ 'searchUpdated', 'perPageUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}