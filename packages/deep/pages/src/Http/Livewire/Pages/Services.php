<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Pages;

class Services extends Component
{
    public function mount(){
        $this->data = Pages::whereIn( 'type', ['Service', 'Regional'] )->whereNotNull('media_id')->active()
                        ->orderby('name', 'ASC')->get();
    }

    public function render(){ return view('deep::livewire.pages.services')->layout('layouts.admin'); }
}