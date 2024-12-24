<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Banner;
use Livewire\WithFileUploads;

use Livewire\WithPagination;

class AdminBanner extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $model, $model_id, $model_options = [], $page_name, $heading, $url, $text, $image, $mobile_image, $media_id, $mobile_media_id, $status, $display_order, $old_image, $old_mobile_image, $data_id;
    public $isOpen = 0, $perPage = 100, $search;

    public function render(){
        $data = Banner::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-banner', [ "data" => $data ])->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'model'                     => 'required',
            'model_id'                  => 'required|numeric',
            'heading'                   => 'required',
            'text'                      => 'required',
            'status'                    => 'required|numeric',
        ]);

        if( !$this->media_id ){
            $this->validate([
                'image'                 => 'required | image | max:2048',
                'mobile_image'          => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            if($this->image){
                $this->media_id = addOrUpdateSingleImage( $this->image, 'banner-slider', $this->page_name, $this->page_name, $this->media_id );
            }

            if($this->mobile_image){
                $this->mobile_media_id = addOrUpdateSingleImage( $this->mobile_image, 'banner-slider-mobile', $this->page_name, $this->page_name, $this->mobile_media_id );
            }

            Banner::updateOrCreate(['id' => $this->data_id], [
                'model'                 =>  $this->model,
                'model_id'              =>  $this->model_id,
                'heading'               =>  $this->heading,
                'url'                   =>  $this->url,
                'text'                  =>  $this->text,
                'media_id'              =>  $this->media_id,
                'mobile_media_id'       =>  $this->mobile_media_id,
                'status'                =>  $this->status,
                'display_order'         =>  (int)$this->display_order,
            ]);

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Banner Updated Successfully.' : 'Banner Created Successfully.' ]);
            $this->resetInputFields();
        }, 3);
    }

    public function changeStatus($id, $status){
        $message = changeStatus('banner_sliders', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function updatedModel(){
        $this->model_id             = null;
        if( $this->model == "Page" ){
            $this->model_options = Pages::select('id', 'name')->active()->orderBy('name', 'ASC')->get();
        }
    }

    public function updatedModelId(){
        if( $this->model_id ){
            $check                          =   Pages::where('id', $this->model_id)->first(); 
            $this->page_name                =   $check ? optional($check->page)->name : "home";
        }
    }

    public function edit($id){
        $this->data_id                  =   decode($id);

        $check                          =   Banner::where('id', $this->data_id)->first();


        if( !$check ){ 
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Banner Not Found' ]);
            return;
        }

        $this->model                    =   $check->model;
        $this->updatedModel();
        $this->page_name                =   optional($check->page)->name;
        $this->heading                  =   $check->heading;
        $this->url                      =   $check->url;
        $this->text                     =   $check->text;
        $this->status                   =   $check->status;
        $this->display_order            =   $check->display_order;
        $this->media_id                 =   $check->media_id;
        $this->mobile_media_id          =   $check->mobile_media_id;
        $this->old_image                =   optional($check->media)->path;
        $this->old_mobile_image         =   optional($check->mobile_media)->path;        
        $this->model_id                 =   $check->model_id;
        $this->isOpen                   =   true;
        $this->dispatch( 'initializeCKEditor' );
    }

    private function resetInputFields(){
        $this->model                    =   null;
        $this->model_id                 =   null;
        $this->heading                  =   null;
        $this->url                      =   null;
        $this->text                     =   null;
        $this->status                   =   null;
        $this->display_order            =   null;
        $this->media_id                 =   null;
        $this->image                    =   null;
        $this->old_image                =   null;
        $this->mobile_media_id          =   null;
        $this->mobile_image             =   null;
        $this->old_mobile_image         =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
        $this->model_options            =   [];
        $this->dispatch('destroyAllCKEditors');
    }
    
    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ 
        $this->isOpen = 1; $this->status = 1;
        $this->dispatch( 'initializeCKEditor' );
    }
}