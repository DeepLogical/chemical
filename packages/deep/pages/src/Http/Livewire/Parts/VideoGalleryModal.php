<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Deep\Pages\Models\VideoGallery;
use Livewire\WithFileUploads;

class VideoGalleryModal extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $hide_btn = 0, $model, $model_id, $url, $status, $display_order, $data, $data_id;

    public function mount(){
        $this->getData();
    }

    public function render(){ return view('deep::livewire.parts.video-gallery-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'status'                       =>  'required|numeric',
        ]);

        DB::transaction(function () {
            $data = VideoGallery::updateOrCreate(['id' => $this->data_id], [
                'model'                 =>  $this->model,
                'model_id'              =>  $this->model_id,
                'url'                   =>  $this->url,
                'status'                =>  $this->status,
                'display_order'         =>  $this->display_order,
            ]);
            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Video Updated Successfully.' : 'Video Created Successfully.' ]);

            $this->closeModal();
            $this->getData();
        }, 3);
    }

    public function edit( $id ){
        $this->data_id                  =   decode( $id );
        $check                          =   VideoGallery::where('id', $this->data_id)->first();
        if( !$check ){ return; }

        $this->media_id                 =   $check->media_id;
        $this->url                      =   $check->url;
        $this->status                   =   $check->status;
        $this->display_order            =   $check->display_order;
        $this->isOpen                   =   1;
    }

    private function getData(){
        $this->data                   =   VideoGallery::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }

    public function openModal(){ $this->isOpen = true; $this->status = 1; }
    public function closeModal(){ $this->resetInputFields(); }
    private function resetInputFields(){
        $this->url                      =   null;
        $this->status                   =   null;
        $this->display_order            =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
    }
}