<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use Auth;
use Deep\Pages\Models\Comment;

class SingleComments extends Component
{
    public $model, $model_id, $type, $title, $name, $email, $comment, $comments, $response;
    public $isOpen = 0, $c_order = 0, $comment_id = 0;

    public function mount( $model, $title, $model_id ){
        $this->model                    =   $model;
        $this->model_id                 =   $model_id;
        $this->title                    =   $title;
        $this->name                     =   Auth::check() ? Auth::user()->name : null;
        $this->email                    =   Auth::check() ? Auth::user()->email : null;

        $this->comments                 =   Comment::where([ [ 'model', $this->model ], [ 'model_id', $this->model_id ], ['c_order', 0] ])->get();
    }

    public function render(){
        return view('deep::livewire.parts.single-comments');
    }

    public function submit(){
        $this->validate([
            'name'                      =>  'required',
            'email'                     =>  'required',
            'comment'                   =>  'required',
        ]);

        Comment::create([
            'model'                     =>  $this->model,
            'model_id'                  =>  $this->model_id,
            'c_order'                   =>  $this->c_order,
            'comment_id'                =>  $this->comment_id,
            'user_id'                   =>  Auth::check() ? Auth::user()->id : null,
            'name'                      =>  $this->name,
            'email'                     =>  $this->email,
            'comment'                   =>  $this->comment,
            'status'                    =>  0
        ]);
        $this->resetInputFields();
        $this->dispatch('alert', ['type' => 'success',  'message' => 'Comment sent for approval.' ]);
    }

    public function openModal($id){
        $this->comment_id               =   $id;
        $this->c_order                  =   1;
        $this->isOpen                   =   true;
    }

    public function closeModal(){ $this->resetInputFields(); }

    private function resetInputFields(){
        $this->comment                  =   null;
        $this->comment_id               =   0;
        $this->c_order                  =   0;
        $this->isOpen                   =   false;
    }
}