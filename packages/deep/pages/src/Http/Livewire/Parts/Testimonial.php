<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Pages\Models\Testimonial as Model;

class Testimonial extends Component
{
    public $model, $model_id, $data, $title, $content;

    public function mount(){
        $this->data             =   Model::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }
    
    public function render(){ return view('deep::livewire.parts.testimonial'); }
}