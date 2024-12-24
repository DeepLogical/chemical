<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Pages;

class FaqPage extends Component
{
    public $ur, $data;

    public function mount(){
        $this->url = cleanURL( url()->current() );
        $this->data = Pages::select('id', 'url')->where('url', $this->url)->first();
    }

    public function render(){ return view('deep::livewire.pages.faq-page'); }
}