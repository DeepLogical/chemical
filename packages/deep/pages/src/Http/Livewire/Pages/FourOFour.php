<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Pages;

class FourOFour extends Component
{
    public function render(){ return view('deep::livewire.pages.four-o-four')->layout('layouts.admin'); }
}