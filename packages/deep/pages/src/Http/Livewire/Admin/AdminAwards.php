<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Awards;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminAwards extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $image, $media_id, $status, $old_image, $data_id;
    
    public $isOpen = 0, $perPage = 50, $search;

    public function render(){
        $data =   Awards::with('media:id,path')->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-awards', ["data" => $data])->layout('layouts.admin');
    }

    public function changeStatus($id, $status){
        $message = changeStatus('awards', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function submit(){
        $this->validate([
            'name' => 'required',
        ]);

        if( !$this->media_id ){
            $this->validate([
                'image' => 'required | image | max:2048',
            ]);
        }
        DB::transaction(function () {
            if($this->image){
                $this->media_id = addOrUpdateSingleImage( $this->image, 'award', $this->name, $this->name, $this->media_id );
            }

            $entry = Awards::updateOrCreate(['id' => $this->data_id], [
                'name' => $this->name,
                'status' => $this->status,
                'media_id' => $this->media_id,
            ]);

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Award Updated Successfully.' : 'Award Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($i){
        $this->name = $i['name'];
        $this->status = $i['status'];
        if($i['media_id']){
            $this->media_id = $i['media_id'];
            $this->old_image = $i['media']['path'];
        }
        $this->data_id = $i['id'];
        $this->isOpen = true;
    }

    private function resetInputFields(){
        $this->name                     = null;
        $this->media_id                 = null;
        $this->old_image                 = null;
        $this->status                   = null;
        $this->data_id                  = null;
        $this->isOpen                   = false;
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}