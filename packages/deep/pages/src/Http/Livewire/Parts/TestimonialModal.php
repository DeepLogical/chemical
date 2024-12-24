<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Testimonial;
use Livewire\WithFileUploads;

class TestimonialModal extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $initModal = 0, $model, $model_id, $model_options = [], $name, $role, $image, $old_image, $media_id, $testis, $status, $display_order, $data_id;

    public function render(){ return view('deep::livewire.parts.testimonial-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'model_id'                  => 'required|numeric',
            'model'                     => 'required',
            'name'                      => 'required',
            'role'                      => 'required',
            'testis'                    => 'required',
            'status'                    => 'required',
        ]);

        DB::transaction(function () {
            if( $this->image ){
                $this->media_id = addOrUpdateSingleImage($this->image, 'testimonials', $this->model, $this->model, $this->media_id );
            }

            Testimonial::updateOrCreate(['id' => $this->data_id], [
                'model'                 =>  $this->model,
                'model_id'              =>  $this->model_id,
                'media_id'              =>  $this->media_id,
                'name'                  =>  $this->name,
                'role'                  =>  $this->role,
                'testis'                =>  $this->testis,
                'status'                =>  $this->status,
                'display_order'         =>  $this->display_order,
            ]);

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Testimonial Updated Successfully.' : 'Testimonial Created Successfully.' ]);
            $this->resetInputFields();
            $this->dispatch('testimonialModalUpdated');
        }, 3);
    }

    public function closeModal(){ $this->resetInputFields(); $this->dispatch('refreshComponent'); }
    protected $listeners = [ 'createTestimonialModal', 'openTestimonialModal', 'updateTestimonialModal', 'refreshComponent'=> '$refresh' ];

    public function createTestimonialModal($model, $id){
        $this->resetInputFields();
        $this->model                        =   $model;
        $this->model_id                     =   decode( $id );
        $this->status                       =   1;
        $this->isOpen                       =   1;
        $this->dispatch( 'initializeCKEditor' );
    }

    public function openTestimonialModal(){
        $this->resetInputFields();
        $this->status                       =   1;
        $this->isOpen                       =   1;
        $this->dispatch('initializeCKEditor');
        $this->initModal                =   1;
        $this->updatedModel();
    }

    public function updateTestimonialModal( $id ){
        $this->dispatch('refreshComponent');
        $this->data_id                      =   decode( $id );
        $data                               =   Testimonial::where('id', $this->data_id)->first();

        if( !$data ){ return; }

        $this->model                        =   $data->model;
        $this->model_id                     =   $data->model_id;
        $this->name                         =   $data->name;
        $this->role                         =   $data->role;
        $this->testis                       =   $data->testis;
        $this->status                       =   $data->status;
        $this->display_order                =   $data->display_order;
        $this->media_id                     =   $data->media_id;
        $this->old_image                    =   optional($data->media)->path;
        $this->isOpen                       =   1;
        $this->dispatch( 'initializeCKEditor' );
    }

    public function updatedModel(){
        $this->model_id             = null;
        if( $this->model == "Page" ){
            $this->model_options = Pages::select('id', 'name')->orderBy('name', 'ASC')->get();
        }
    }

    private function resetInputFields(){
        $this->initModal                    =   null;
        $this->name                         =   null;
        $this->role                         =   null;
        $this->testis                       =   null;
        $this->status                       =   null;
        $this->display_order                =   null;
        $this->data_id                      =   null;
        $this->media_id                     =   null;
        $this->image                        =   null;
        $this->old_image                    =   null;
        $this->isOpen                       =   false;
        $this->dispatch('destroyAllCKEditors');
    }
}