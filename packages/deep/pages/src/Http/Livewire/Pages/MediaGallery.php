<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\PhotoGallery;
use Deep\Admin\Models\Adminsetting;

class MediaGallery extends Component
{
    public $data;
    
    public function mount(){
        $this->data =   PhotoGallery::with(['categoryName:id,name,value', 'media:id,path,media'])->active()->get();
    }

    public function render(){ return view('deep::livewire.pages.media-gallery')->layout('layouts.admin'); }
}