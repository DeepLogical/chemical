<?php

namespace Deep\Blogs\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Blogs\Models\Author;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Intervention\Image\ImageManagerStatic as Image;

class AdminAuthor extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $status, $bio, $media_id, $image, $old_image, $data_id;
    public $isOpen = 0, $perPage = 100, $search;

    public $images = [];

    public $links = [
        [ "name" => "Blogs", "link" => "adminBlog" ],
        [ "name" => "Blogmeta", "link" => "adminBlogmeta" ],
    ];
    
    public function render(){
        $data =   Author::with(['media:id,alt,path'])->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-author', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'name'      => 'required',
            'status'    => 'required',
            'bio'       => 'required',
        ]);

        if(!$this->data_id){
            $this->validate([
                'image' => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            if($this->image){
                $this->media_id = addOrUpdateSingleImage($this->image, 'author', $this->name, $this->name, $this->media_id );
            }

            Author::updateOrCreate(['id' => $this->data_id], [
                'name'          =>  $this->name,
                'status'        =>  $this->status,
                'bio'           =>  $this->bio,
                'media_id'      =>  $this->media_id
            ]);
            
            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Author Updated Successfully.' : 'Author Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($id){
        $this->data_id      = decode( $id );
        $check = Author::where('id', $this->data_id)->first();

        if( $check ){
            $this->name         = $check->name;
            $this->status       = $check->status;
            $this->old_image     = optional($check->media)->path;
            $this->media_id     = $check->media_id;
            $this->bio          = $check->bio;
            $this->isOpen       = true;
        }
    }

    private function resetInputFields(){
        $this->name                 = null;
        $this->status               = null;
        $this->media_id             = null;
        $this->bio                  = null;
        $this->data_id              = null;
        $this->isOpen               = false;
        $this->image                = null;
        $this->old_image             = null;
    }

    public function changeStatus($id, $status){
        $message = changeStatus('authors', 'status', $id, $status);
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