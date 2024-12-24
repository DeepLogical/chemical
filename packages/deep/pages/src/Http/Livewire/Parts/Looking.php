<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class Looking extends Component
{
    public $text, $link, $a_text, $url;

    public function mount($text, $link = null, $url = null, $a_text){
        $this->text = $text;
        $this->link = $link;
        $this->url = $url;
        $this->a_text = $a_text;
    }

    public function render(){
        return view('deep::livewire.parts.looking');
    }
}
