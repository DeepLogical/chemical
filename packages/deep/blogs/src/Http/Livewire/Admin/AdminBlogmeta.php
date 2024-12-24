<?php

namespace Deep\Blogs\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Blogs\Models\Blogmeta;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminBlogmeta extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $url, $type, $name, $title, $description, $data_id, $meta_id, $image, $old_image, $media_id;
    public $isOpen = 0, $perPage = 100, $search;
    public $filter_type, $filter_status;

    public $links = [
        [ "name" => "Blogs", "link" => "adminBlog" ],
        [ "name" => "Authors", "link" => "adminAuthor" ],
    ];
    
    public function render(){
        $query =   Blogmeta::search($this->search)->orderBy('id', 'DESC');

        if( $this->filter_type ){
            $query          =   $query->where('type', $this->filter_type);
        }

        $data               =   $query->paginate($this->perPage);
        return view('deep::livewire.admin.admin-blogmeta', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'url'                   => 'required',
            'type'                  => 'required',
            'name'                  => 'required',
        ]);

        // $validate_meta          =   validateMeta( $this->title, $this->description );
        // if( !$validate_meta ){
        //     $this->dispatch('alert', ['type' => 'error',  'message' => 'Meta Validation failed' ]);
        //     return;
        // }

        DB::transaction(function () {
            $url = sanitizeURL($this->url);

            if( $this->image ){
                $this->media_id = addOrUpdateSingleImage($this->image, 'blogmeta', $this->name, $url, $this->media_id );
            }

            $entry = Blogmeta::updateOrCreate(['id' => $this->data_id], [
                'url'               =>  $url,
                'type'              =>  $this->type,
                'media_id'          =>  $this->media_id,
                'name'              =>  $this->name
            ]);

            $check = Blogmeta::select('url')->findOrFail($entry->id);
            if($check){
                addOrUpdateMeta( $check->url, $this->title, $this->description, $this->meta_id, $this->media_id );
            }
            
            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Blog Meta Updated Successfully.' : 'Blog Meta Created Successfully.', ]);
            $this->closeModal();
        }, 3);
    }

    public function edit($id){
        $this->data_id                  =   decode($id);
        $check                          =   Blogmeta::where('id', $this->data_id)->first();

        if( !$check ){
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Entry Not Found' ]);
            return;
        }

        $this->url                      =   $check->url;
        $this->title                    =   optional( $check->meta )->title;
        $this->description              =   optional( $check->meta )->description;
        $this->meta_id                  =   optional( $check->meta )->id;
        $this->type                     =   $check->type;
        $this->name                     =   $check->name;
        $this->media_id                 =   $check->media_id;
        $this->old_image                =   optional( $check->media )->path;
        $this->isOpen                   =   true;
    }

    public function clear_filters(){
        $this->filter_type              =   null;
        $this->filter_status            =   null;
    }

    private function resetInputFields(){
        $this->url                      =   null;
        $this->type                     =   null;
        $this->name                     =   null;
        $this->title                    =   null;
        $this->description              =   null;
        $this->data_id                  =   null;
        $this->meta_id                  =   null;
        $this->media_id                 =   null;
        $this->image                    =   null;
        $this->old_image                =   null;
        $this->isOpen                   =   false;
        $this->filter_type              =   null;
        $this->filter_status            =   null;
    }
    
    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}