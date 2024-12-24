<?php

namespace Deep\Seo\Http\Livewire\Schema;

use Livewire\Component;

use Deep\Pages\Models\Pages;

class PageSchema extends Component
{
    public $url, $data;

    public function mount($url){
        $this->url = !$url ? "/" : $url;

        $this->data         =   Pages::where('url', $this->url)->first();
    }

    public function render(){ 
        return view('deep::livewire.schema.page-schema')->layout('layouts.guest');
    }
}