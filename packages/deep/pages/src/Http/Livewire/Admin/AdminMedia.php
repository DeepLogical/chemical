<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Media;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminMedia extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $site, $alt, $path, $image, $mediaId, $old_image;
    public $isOpen = 0;
    public $perPage = 50;
    public $search;
    public $perPageOptions = [10,25,50,100,1000];

    public function render(){
        $data =   Media::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-media', ["data" => $data])->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'alt' => 'required',
        ]);

        if(!$this->mediaId){
            $this->validate([
                'image' => 'required',
            ]);
        }
        
        DB::transaction(function () {
            if($this->image){
                addOrUpdateSingleImage($this->image, 'infographics', $this->alt, $this->alt, $this->mediaId );
            }else{
                if($this->mediaId){
                    Media::where('id', $this->mediaId)->update([
                        'alt' => $this->alt
                    ]);
                }
            }

            $this->dispatch('alert', ['type' => 'success',  'message' => $this->mediaId ? 'Media Updated Successfully.' : 'Media Created Successfully.' ]);
            $this->closeModal();

        }, 3);
    }

    public function edit($i){
        $this->alt = $i['alt'];
        $this->path = $i['path'];
        $this->mediaId = $i['id'];
        $this->isOpen = true;
        $this->old_image = $i['path'];
    }

    private function resetInputFields(){
        $this->alt                      = null;
        $this->path                     = null;
        $this->mediaId                  = null;
        $this->old_image                 = null;
        $this->isOpen                   = false;
    }
    
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }

}
