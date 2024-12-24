<?php

namespace Deep\Pages\Http\Livewire\Faq;

use Livewire\Component;

use Deep\Pages\Models\Faq;

use DB;
use Deep\Pages\Models\Pages;

class FaqModal extends Component
{
    public $isOpen = 0, $model, $model_id, $model_options = [], $quest, $ans, $status, $display_order, $data_id, $data;

    public function render(){ return view('deep::livewire.faq.faq-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'model_id'                  => 'required|numeric',
            'model'                     => 'required',
            'quest'                     => 'required',
            'ans'                       => 'required',
            'status'                    => 'required',
        ]);

        DB::transaction(function () {
            Faq::updateOrCreate(['id' => $this->data_id], [
                'model'                 =>  $this->model,
                'model_id'              =>  $this->model_id,
                'quest'                 =>  $this->quest,
                'ans'                   =>  $this->ans,
                'status'                =>  $this->status,
                'display_order'         =>  $this->display_order,
            ]);

            $this->dispatch('alert', ['model' => 'success', 'message' => $this->data_id ? 'Faq Updated Successfully.' : 'Faq Created Successfully.' ]);
            $this->resetInputFields();
            $this->dispatch('faqModalUpdated');
        }, 3);
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = [ 'createFaqModal', 'openFaqModal', 'updateFaqModal' ];

    public function createFaqModal($model, $id){
        $this->resetInputFields();
        $this->model                        =   $model;
        $this->model_id                     =   decode( $id );
        $this->status                       =   1;
        $this->isOpen                       =   1;
    }

    public function openFaqModal(){
        $this->resetInputFields();
        $this->status                       =   1;
        $this->isOpen                       =   1;
        $this->updatedModel();
        $this->dispatch('initializeCKEditor');
    }

    public function updatedModel(){
        if( $this->model == "Page" ){
            $this->model_options = Pages::select('id', 'name')->orderBy('name', 'ASC')->get();
        }
    }

    public function updateFaqModal( $id ){
        $this->data_id                      =   decode( $id );
        $data                               =   Faq::where('id', $this->data_id)->first();

        if( !$data ){ return; }

        $this->model                        =   $data->model;
        $this->model_id                     =   $data->model_id;
        $this->quest                        =   $data->quest;
        $this->ans                          =   $data->ans;
        $this->status                       =   $data->status;
        $this->display_order                =   $data->display_order;
        $this->isOpen                       =   1; 
        $this->updatedModel();
        $this->dispatch( 'initializeCKEditor' );
    }

    private function resetInputFields(){
        $this->quest                        =   null;
        $this->ans                          =   null;
        $this->status                       =   null;
        $this->display_order                =   null;
        $this->data_id                      =   null;
        $this->isOpen                       =   false;
        $this->dispatch('destroyAllCKEditors');
    }
}