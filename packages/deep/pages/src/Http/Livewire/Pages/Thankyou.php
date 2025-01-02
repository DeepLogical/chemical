<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use \Cookie as Cookie;
use Deep\Pages\Models\Pages;

class Thankyou extends Component
{

    public $data = [];

    public function mount(){
        // $this->data = Pages::where([ ['status', 1], ['type', 'Service'] ])->whereNotNull('media_id')->with(['media:id,media,alt'])->get();
    }

    public function render(){ return view('deep::livewire.pages.thankyou')->layout('layouts.admin'); }

    public function check_action(){
        $action_id = Cookie::get('action_id');

        if( $action_id ){
            close_action( $action_id );
        }
    }
}