<?php

namespace Deep\Seo\Http\Livewire\Seo;

use Livewire\Component;

use Deep\Seo\Models\MetaInterface;
use Livewire\WithPagination;

class UploadMeta extends Component
{
    use WithPagination;
    
    public $perPage = 100, $search, $sortBy = 'id', $sortDirection = 'desc', $batch, $status, $status_options = [ 'Success', 'Failed' ];

    public $fromDate, $toDate, $onDate, $org;

    public function mount($batch){
        $this->batch = $batch;
    }
    
    public function render(){
        $query      =   MetaInterface::where('batch_no', $this->batch);

        if( $this->status ){
            $query = $query->where('status', $this->status );
        }

        $data       =   $query->search($this->search)->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('deep::livewire.seo.upload-meta', [ "data" => $data ] )->layout('layouts.admin');
    }

    public function clearInterface(){
        MetaInterface::truncate();

        $this->dispatch('alert', ['type' => 'success',  'message' => 'Meta Interface Cleared Successfully.' ]);
    }

    protected $listeners = [ 'openModalCalled', 'searchUpdated', 'perPageUpdated', 'dateRangeUpdated', 'specificDateSelected'];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){  $this->clearInterface(); }

    public function dateRangeUpdated($fromDate, $toDate){ 
        $this->fromDate         = $fromDate;
        $this->toDate           = $toDate;
        $this->onDate           = null;
    }

    public function specificDateSelected($onDate){ 
        $this->fromDate         = null;
        $this->toDate           = null;
        $this->onDate           = $onDate;
    }
}