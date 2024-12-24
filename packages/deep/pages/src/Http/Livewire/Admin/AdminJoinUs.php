<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Career;
use Illuminate\Support\Facades\Response;
use Livewire\WithPagination;

class AdminJoinUs extends Component
{
    use WithPagination;
    public $entry, $isOpen = 0, $perPage = 50, $search;
    public $status, $admin_remarks, $data_id;

    public function mount(){
        clearNotifications( route('adminJoinUs') );
    }

    public function render(){
        $data =   Career::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);

        return view('deep::livewire.admin.admin-join-us', ["data" => $data])->layout('layouts.admin');
    }

    public function downloadFile($folder, $filename){
        $file_path = storage_path() . '/app/'.$folder.'/'. $filename;

        if (file_exists($file_path)) {
            return Response::download($file_path, $filename, [
                'Content-Length: ' . filesize($file_path)
            ]);
        } else {
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Requested file does not exist on our server!' ]);
        }
    }

    public function submit(){
        $this->validate([
            'status' => 'required',
        ]);
        
        DB::transaction(function () {
            Career::where('id', $this->data_id)->update([
                'status'                =>  $this->status,
                'admin_remarks'         =>  $this->admin_remarks,
            ]);

            $this->dispatch('alert', ['type' => 'success',  'message' => 'Application Updated Successfully.' ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($id){
        $this->data_id                  =   decode( $id );
        $this->entry                     =   Career::where('id', $this->data_id)->first();

        if( !$this->entry ){ return; }

        $this->status                   =   $this->entry->status;
        $this->admin_remarks            =   $this->entry->admin_remarks;
        $this->isOpen                   =   1;
    }

    private function resetInputFields(){
        $this->entry                    = null;
        $this->status                  = null;
        $this->admin_remarks           = null;
        $this->data_id                 = null;
        $this->isOpen                  = false;
    }
    
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}