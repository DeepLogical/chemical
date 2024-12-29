<?php

namespace Deep\Products\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Products\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;


class AdminProduct extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $status, $manufacturer, $media_id, $image, $old_image, $data_id, $functions, $end, $tds, $url;
    public $isOpen = 0, $perPage = 100, $search;

    public $images = [];

    public $links = [
        [ "name" => "Products", "link" => "adminProduct" ],
        [ "name" => "Productmeta", "link" => "adminProductmeta" ],
    ];
    
    public function render(){
        $data =   Product::with(['media:id,alt,path'])->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-product', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'name'         => 'required',
            'status'       => 'required',
            'manufacturer' => 'required',
            'functions'    => 'required',
            'tds'          => 'required',
            'url'          => 'required',
            'end'          => 'required',


        ]);

        if(!$this->data_id){
            $this->validate([
                'image' => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            if($this->image){
                $this->media_id = addOrUpdateSingleImage($this->image, 'product', $this->name, $this->name, $this->media_id );
            }

            Product::updateOrCreate(['id' => $this->data_id], [
                'name'          =>  $this->name,
                'status'        =>  $this->status,
                'media_id'      =>  $this->media_id,
                'manufacturer'  =>  $this->manufacturer, 
                'functions'     =>  $this->functions,
                'tds'           =>  $this->tds,
                'url'           =>  $this->url,
                'end'           =>  $this->end,
            ]);
            
            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Product Updated Successfully.' : 'Product Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($id){
        $this->data_id      = decode( $id );
        $check = Product::where('id', $this->data_id)->first();

        if( $check ){
            $this->name                 = $check->name;
            $this->manufacturer         = $check->manufacturer;
            $this->end                  = $check->end;
            $this->functions            = $check->functions;
            $this->tds                  = $check->tds;
            $this->status               = $check->status;
            $this->old_image            = optional($check->media)->path;
            $this->media_id             = $check->media_id;
            $this->isOpen               = true;
        }
    }

    private function resetInputFields(){
        $this->name                 = null;
        $this->manufacturer         = null;
        $this->end                  = null;
        $this->functions            = null;
        $this->tds                  = null;
        $this->status               = null;
        $this->media_id             = null;
        $this->data_id              = null;
        $this->isOpen               = false;
        $this->image                = null;
        $this->old_image            = null;
    }

    public function changeStatus($id, $status){
        $message = changeStatus('products', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message ]);
    }
    
    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }

    public function resize(){
        foreach ($this->images as $key => $i) {
            $fileName = $i->getClientOriginalName(); // Retrieve original filename        
            Image::make($i->path())->fit(350, 150, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('small/').$fileName); // Save with original filename
            
            Image::make($i->path())->fit(100, 42, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('thumbnail/').$fileName); // Save with original filename

            $this->dispatch('alert', ['type' => 'success',  'message' => "Image Resized" ]);
        }
    }
}