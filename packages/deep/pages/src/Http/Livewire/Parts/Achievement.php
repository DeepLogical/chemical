<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Pages\Models\Achievement as Model;

class Achievement extends Component
{
    public $model, $model_id, $data;

    public function mount(){
        $this->data                 =   Model::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }
    
    public function render(){ return view('deep::livewire.parts.achievement'); }
}