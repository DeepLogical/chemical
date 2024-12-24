<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use Auth;
use Deep\Pages\Models\Comment;
use Livewire\WithPagination;

class AdminComments extends Component
{
    use WithPagination;

    public $url, $type, $name, $data_id, $comment, $status;
    public $isOpen = 0, $perPage = 100, $search;
    // public $data;


    public function mount(){
        clearNotifications( route('adminComments') );
    }

    public function render(){
        $data =   Comment::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-comments', [ 'data' => $data ])->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'comment'       => 'required',
            'status'        => 'required',
        ]);
        
        Comment::where([ ['id', $this->data_id] ])->update([
            'comment'       => $this->comment,
            'status'        => $this->status
        ]);
        
        $this->dispatch('alert', ['type' => 'success',  'message' => 'Comment Updated Successfully.' ]);
        $this->resetInputFields();
    }
    
    public function edit($id){
        $this->data_id          =   decode( $id );

        $check                  =   Comment::where([ ['id', $this->data_id] ])->first();
        if( $check ){
            $this->name         =   $check->name;
            $this->email        =   $check->email;
            $this->comment      =   $check->comment;
            $this->status       =   $check->status;
            $this->isOpen       =   true;       
        }
    }

    public function changeStatus($id, $status){
        $message = changeStatus('comments', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message ]);
    }

    private function resetInputFields(){
        $this->name             =   null;
        $this->email            =   null;
        $this->comment          =   null;
        $this->status           =   null;
        $this->data_id          =   null;
        $this->isOpen           =   false;
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}