<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Prize;
use Livewire\WithFileUploads;

class PrizeModal extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $model, $model_id, $rank, $prize, $image, $old_image, $media_id, $status, $display_order, $data, $data_id;

    public function mount(){
        $this->getData();
    }

    public function render(){ return view('deep::livewire.parts.prize-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'rank'                      =>  'required',
            'status'                       =>  'required|numeric',
        ]);

        // if( !$this->media_id ){
        //     $this->validate([
        //         'image'                 => 'required | image | max:2048',
        //     ]);
        // }

        DB::transaction(function () {
            if( $this->image ){
                $this->media_id = addOrUpdateSingleImage($this->image, 'gallery', $this->rank, $this->rank, $this->media_id );
            }

            $data = Prize::updateOrCreate(['id' => $this->data_id], [
                'model'                 =>  $this->model,
                'model_id'              =>  $this->model_id,
                'media_id'              =>  $this->media_id,
                'rank'                  =>  $this->rank,
                'prize'                  =>  $this->prize,
                'status'                =>  $this->status,
                'display_order'         =>  $this->display_order,
            ]);
            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Media Updated Successfully.' : 'Media Created Successfully.' ]);

            $this->closeModal();
            $this->getData();
        }, 3);
    }

    public function edit( $id ){
        $this->data_id                  =   decode( $id );
        $check                          =   Prize::where('id', $this->data_id)->first();
        if( !$check ){ return; }

        $this->media_id                 =   $check->media_id;
        $this->old_image                =   optional($check->media)->path;
        $this->rank                  =   $check->rank;
        $this->prize                     =   $check->prize;
        $this->status                   =   $check->status;
        $this->display_order            =   $check->display_order;
        $this->isOpen                   =   1;
    }

    private function getData(){
        $this->data                   =   Prize::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }

    public function openModal(){ $this->isOpen = true; $this->status = 1; }
    public function closeModal(){ $this->resetInputFields(); }
    private function resetInputFields(){
        $this->rank                  =   null;
        $this->prize                     =   null;
        $this->image                    =   null;
        $this->old_image                =   null;
        $this->media_id                 =   null;
        $this->status                   =   null;
        $this->display_order            =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
    }
}