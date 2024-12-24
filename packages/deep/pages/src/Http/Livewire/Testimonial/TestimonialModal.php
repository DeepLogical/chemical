<?php

namespace Deep\Pages\Http\Livewire\Testimonial;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Testimonial;
use Livewire\WithFileUploads;

class TestimonialModal extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $model, $model_id, $model_options = [], $name, $role, $image, $old_image, $media_id, $testis, $status, $display_order, $data_id;

    public function render(){ return view('deep::livewire.testimonial.testimonial-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            "model"                     =>  "required",
            "model_id"                  =>  "required|numeric",
            "name"                      =>  "required",
            "testis"                    =>  "required",
            "status"                    =>  "required|numeric",
        ]);

        if( !$this->media_id ){
            $this->validate([
                'image'                 => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            if($this->image){ $this->media_id = addOrUpdateSingleImage( $this->image, 'testimonials', $this->name, $this->name, $this->media_id ); }

            Testimonial::updateOrCreate(['id' => $this->data_id], [
                "model"                 =>  $this->model,
                "model_id"              =>  $this->model_id,
                "testis"                =>  $this->testis,
                "name"                  =>  $this->name,
                "role"                  =>  $this->role,
                "status"                =>  $this->status,
                "display_order"         =>  $this->display_order,
                "media_id"              =>  $this->media_id,
            ]);
            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Testimonial Updated Successfully.' : 'Testimonial Created Successfully.' ]);
            $this->resetInputFields();
            $this->dispatch('testimonialModalUpdated');
        }, 3);
    }

    public function closeModal(){ $this->resetInputFields(); $this->dispatch('refreshComponent'); }
    protected $listeners = [ 'createTestimonialModal', 'openTestimonialModal', 'updateTestimonialModal', 'refreshComponent'=> '$refresh' ];

    public function createTestimonialModal( $model, $id ){
        $this->resetInputFields();
        $this->model                        =   $model;
        $this->getModalOptions();
        $this->model_id                     =   decode( $id );
        $this->status                       =   1;
        $this->isOpen                       =   1;
    }

    public function openTestimonialModal(){
        $this->resetInputFields();
        $this->status                       =   1;
        $this->isOpen                       =   1;
        $this->getModalOptions();
        $this->dispatch( 'initializeCKEditor' );
    }

    public function updateTestimonialModal( $id ){
        $check                               =   Testimonial::where('id', decode( $id ))->first();
        if( !$check ){ return; }

        $this->data_id                  =   $check->id;
        $this->model                    =   $check->model;
        $this->model_id                 =   $check->model_id;
        $this->testis                   =   $check->testis;
        $this->name                     =   $check->name;
        $this->role                     =   $check->role;
        $this->status                   =   $check->status;
        $this->display_order            =   $check->display_order;
        $this->media_id                 =   optional($check->media)->id;
        $this->old_image                =   optional($check->media)->path;
        $this->getModalOptions();
        $this->isOpen                   =   true;
        $this->dispatch( 'initializeCKEditor' );
    }

    public function updatedModel(){
        $this->model_options                =   [];
        $this->getModalOptions();
    }

    private function getModalOptions(){
        if( !$this->model ){ return; }

        $this->model_options            =   Pages::select( 'id', 'name' )->where('model', $this->model)->orderBy('name', 'ASC')->get();
    }

    private function resetInputFields(){
        $this->testis                   =   null;
        $this->name                     =   null;
        $this->role                     =   null;
        $this->status                   =   null;
        $this->display_order            =   null;
        $this->media_id                 =   null;
        $this->image                    =   null;
        $this->old_image                =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
        $this->dispatch('destroyAllCKEditors');
    }
}