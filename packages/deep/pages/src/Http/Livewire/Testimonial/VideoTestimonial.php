<?php

namespace Deep\Pages\Http\Livewire\Testimonial;

use Livewire\Component;

use Deep\Pages\Models\VideoTestimonial as Model;

class VideoTestimonial extends Component
{
    public $model, $model_id, $data, $heading, $paragraph;

    public function mount(){
        $this->data             =   Model::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();

        $hp                         =   getHP( $this->model, $this->model_id, 'testimonial_title', 'testimonial_text' );
        $this->heading              =   (!empty($hp) && isset($hp['h'])) ? $hp['h'] : "What our Users say about us";
        $this->paragraph            =   (!empty($hp) && isset($hp['p'])) ? $hp['p'] : "Some love shown by our users";
    }
    
    public function render(){ return view('deep::livewire.testimonial.video-testimonial'); }
}