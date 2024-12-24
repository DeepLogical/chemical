<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Video;
use Deep\Admin\Models\Adminsetting;
use Livewire\WithPagination;

class AdminVideos extends Component
{
    use WithPagination;

    public $category_id, $name, $iframe, $status, $data_id;
    public $catOptions = [];

    public $isOpen = false;
    public $perPage = 50;
    public $search;

    public function mount(){
        $check = Adminsetting::select('id')->where([ ['type', 'Basic'], ['name', 'Video Category'] ])->first();
        if($check){
            $this->catOptions  = Adminsetting::select('id', 'name')->where([ ['type', $check->id] ])->get();
        }
    }

    public function render(){
        $data =   Video::with(['categoryName:id,name,value'])
                    ->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-videos', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'category_id' => 'required',
            'name' => 'required',
            'iframe' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () {
            Video::updateOrCreate(['id' => $this->data_id], [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'iframe' => $this->iframe,
                'status' => $this->status,
            ]);
            
            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Blog Meta Updated Successfully.' : 'Blog Meta Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function changeStatus($id, $status){
        $message = changeStatus('videos', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function edit($i){
        $this->category_id = $i['category_id'];
        $this->name = $i['name'];
        $this->iframe = $i['iframe'];
        $this->status = $i['status'];
        $this->data_id = $i['id'];
        $this->isOpen = true;
    }

    private function resetInputFields(){
        $this->category_id              = null;
        $this->name                     = null;
        $this->iframe                   = null;
        $this->status                   = null;
        $this->data_id                  = null;
        $this->isOpen                   = false;
    }
    
    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}