<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Brand;
use Livewire\WithFileUploads;

class AdminBrand extends Component
{
    use WithFileUploads;

    public $name, $image, $media_id, $old_image, $status, $data_id;
    public $isOpen = false, $sortBy = 'id', $sortDirection = 'desc', $perPage = 100, $search;

    public function render(){
        $data =   Brand::search($this->search)->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('deep::livewire.admin.admin-brand', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function edit($id){
        $this->data_id                  =   decode($id);
        $check  =    Brand::where('id', $this->data_id)->first();

        if( $check ){
            $this->name                 =   $check->name;
            $this->status               =   $check->status;
            $this->media_id             =   $check->media_id;
            $this->old_image            =   optional($check->media)->path;
            $this->isOpen               =   true;
        }
    }

    public function submit(){
        $this->validate([
            'name'              =>  'required',
            'status'            =>  'required|numeric',
        ]);

        if( !$this->media_id ){
            $this->validate([
                'image'                 => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            if( $this->image ){
                $this->media_id = addOrUpdateSingleImage($this->image, 'brands', $this->name, $this->name, $this->media_id );
            }

            Brand::updateOrCreate(['id' => $this->data_id], [
                'name'              =>  $this->name,
                'media_id'          =>  $this->media_id,
                'status'            =>  $this->status,
            ]);
        }, 3);

        $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Brand Updated Successfully.' : 'Brand Created Successfully.' ]);
        $this->closeModal();
    }

    public function changeStatus($id, $status){
        $message = changeStatus('brands', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }
    
    private function resetInputFields(){
        $this->data_id              = null;
        $this->name                 = null;
        $this->image                = null;
        $this->media_id             = null;
        $this->old_image            = null;
        $this->status               = null;
        $this->isOpen               = false;
    }

    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; $this->status = 1; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->openModal(); }
}
