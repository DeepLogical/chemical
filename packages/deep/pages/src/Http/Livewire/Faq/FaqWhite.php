<?php

namespace Deep\Pages\Http\Livewire\Faq;

use Livewire\Component;

use Deep\Pages\Models\Faq;

class FaqWhite extends Component
{
    public $model, $model_id, $heading, $paragraph, $data;

    public function mount(){
        $this->data                 =   Faq::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();

        $hp                         =   getHP( $this->model, $this->model_id, 'faq_title', 'faq_text' );
        $this->heading              =   (!empty($hp) && isset($hp['h'])) ? $hp['h'] : "Frequently asked Questions";
        $this->paragraph            =   (!empty($hp) && isset($hp['p'])) ? $hp['p'] : "Some of the most asked frequently asked question by our users";
    }
    
    public function render(){ return view('deep::livewire.faq.faq-white'); }
}