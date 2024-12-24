<?php

namespace Deep\Pages\Http\Livewire\Faq;

use Livewire\Component;

use Deep\Pages\Models\Faq as Model;

class Faq extends Component
{
    public $model, $model_id, $data, $title, $content;

    public function mount( $model, $model_id ){
        $this->model                =   $model;
        $this->model_id             =   $model_id;

        $this->data                 =   Model::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }
    
    public function render(){ return view('deep::livewire.faq.faq'); }
}