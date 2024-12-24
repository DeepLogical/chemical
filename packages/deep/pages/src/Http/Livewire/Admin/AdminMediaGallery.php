<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\PhotoGallery;
use Deep\Admin\Models\Adminsetting;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminMediaGallery extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $category_id, $name, $image, $images, $status, $media_id, $old_image, $data_id;
    public $catOptions = [];

    public $isOpen = false;
    public $perPage = 50;
    public $search;

    public function mount(){
        $check = Adminsetting::select('id')->where([ ['type', 'Basic'], ['name', 'Media Category'] ])->first();
        if($check){
            $this->catOptions  = Adminsetting::select('id', 'name')->where([ ['type', $check->id] ])->get();
        }
    }

    public function render(){
        $data =   PhotoGallery::with(['categoryName:id,name,value', 'media:id,path,media'])
                    ->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-media-gallery', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'category_id' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () {
            if($this->images){
                $media_id = addMultipleImages( $this->images, 'mediaGallery', $this->name, $this->name, null );

                foreach($media_id as $i){
                    PhotoGallery::create([
                        'category_id' => $this->category_id,
                        'media_id' => $i,
                        'status' => $this->status,
                        'name' => $this->name,
                    ]);
                }
            }else{
                if($this->image){
                    $this->media_id = addOrUpdateSingleImage( $this->image, 'mediaGallery', $this->name, $this->name, $this->media_id );
                }

                PhotoGallery::updateOrCreate(['id' => $this->data_id], [
                    'category_id' => $this->category_id,
                    'media_id' => $this->media_id,
                    'status' => $this->status,
                    'name' => $this->name,
                ]);
            }

            $this->dispatch('alert', ['type' => 'success',  'message' => 'Gallery Updated Successfully.' ]);
            $this->closeModal();
        }, 3);
    }

    public function changeStatus($id, $status){
        $message = changeStatus('photo_galleries', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function edit($i){
        $this->category_id = $i['category_id'];
        $this->status = $i['status'];
        $this->name = $i['name'];
        $this->media_id = $i['media_id'];
        $this->old_image = $i['media']['path'];
        $this->data_id = $i['id'];
        $this->isOpen = true;
    }

    private function resetInputFields(){
        $this->category_id              = null;
        $this->status                   = null;
        $this->name                     = null;
        $this->media_id                 = null;
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