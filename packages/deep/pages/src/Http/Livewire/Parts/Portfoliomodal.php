<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class Portfoliomodal extends Component
{

    public $isOpen = 0, $active, $data, $active_image, $active_key;

    public function render(){ return view('deep::livewire.parts.portfoliomodal'); }

    public function openModal($key){
        $this->active_key           =   $key;
        $this->setImage();
        $this->isOpen               =   true;
    }

    public function closeModal(){
        $this->isOpen               =   false;
        $this->active_image         =   null;
        $this->active_key           =   null;
        $this->check                =   null;
    }

    public function leftActive(){
        if($this->active_key != 0){
            $this->active_key = $this->active_key -1;
        }else{
            $this->active_key = count($this->data)-1;
        }
        $this->setImage();
    }

    public function rightActive(){
        if($this->active_key != count($this->data)-1){
            $this->active_key = $this->active_key +1;
        }else{
            $this->active_key = 0;
        }
        $this->setImage();    
    }

    private function setImage(){
        $this->active_image         =   $this->data[$this->active_key]['path'];
    }

    protected $listeners = ['openPortfolioModal'];

    public function openPortfolioModal($check){
        $this->openModal($check);
    }
}