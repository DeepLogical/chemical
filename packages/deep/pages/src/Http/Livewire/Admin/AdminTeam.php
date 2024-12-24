<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Team;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminTeam extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $designation, $image, $media_id, $status, $old_image, $text, $data_id;    
    public $isOpen = 0, $perPage = 100, $search;

    public function render(){
        $data =   Team::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-team', ["data" => $data])->layout('layouts.admin');
    }

    public function changeStatus($id, $status){
        $message = changeStatus('teams', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function submit(){
        $this->validate([
            'name'                      => 'required',
            'designation'               => 'required',
            'status'                    => 'required|numeric',
        ]);

        if( !$this->media_id ){
            $this->validate([
                'image' => 'required | image | max:2048',
            ]);
        }
        DB::transaction(function () {
            if($this->image){
                $this->media_id = addOrUpdateSingleImage( $this->image, 'team', $this->name, $this->name, $this->media_id );
            }

            $entry = Team::updateOrCreate(['id' => $this->data_id], [
                'name'                      => $this->name,
                'designation'               => $this->designation,
                'text'                      => $this->text ? : null,
                'status'                    => $this->status,
                'media_id'                  => $this->media_id ? : null,
            ]);

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Team Updated Successfully.' : 'Team Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($i){
        $this->name                         = $i['name'];
        $this->designation                  = $i['designation'];
        $this->text                         = $i['text'];
        $this->status                       = $i['status'];
        if($i['media_id']){
            $this->media_id                 = $i['media_id'];
            $this->old_image                = $i['media']['path'];
        }
        $this->data_id                      = $i['id'];
        $this->isOpen                       = true;
    }

    private function resetInputFields(){
        $this->name                         = null;
        $this->designation                  = null;
        $this->text                         = null;
        $this->media_id                     = null;
        $this->old_image                    = null;
        $this->status                       = null;
        $this->data_id                      = null;
        $this->isOpen                       = false;
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; }
}