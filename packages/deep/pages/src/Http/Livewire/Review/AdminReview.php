<?php

namespace Deep\Pages\Http\Livewire\Review;

use Livewire\Component;

use App\Models\User;
use Deep\Pages\Models\Review;
use Deep\Ecom\Models\Product;

class AdminReview extends Component
{
    public $model_name, $model, $model_id, $status, $review, $rating, $data_id;
    public $isOpen = false, $sortBy = 'id', $sortDirection = 'desc', $perPage = 100, $search;

    public function render(){
        $data =   Review::search($this->search)->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('deep::livewire.review.admin-review', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function edit( $id ){
        $check              =   Review::where( 'id', decode( $id ) )->first();
        if( !$check ){ return; }
        
        $this->data_id                  =   $check->id;
        $this->model                    =   $check->model;
        $this->model_id                 =   $check->model_id;
        $this->rating                   =   $check->rating;
        $this->review                   =   $check->review;
        $this->status                   =   $check->status;
        if( $this->model == 'Product' ){
            $this->model_name               =   optional($check->product)->name;
        }
        if( $this->model == 'Training' ){
            $this->model_name               =   optional($check->training)->name;
        }
        if( $this->model == 'Coach' ){
            $this->model_name               =   optional(optional($check->coach)->user)->name;
        }
        $this->isOpen                   =   true;
    }

    public function submit(){
        $this->validate([
            'rating'                    =>  'required',
            'status'                    =>  'required',
            'review'                    =>  'required',
        ]);

        Review::where( 'id', $this->data_id )->update([
            'rating'                    =>  $this->rating,
            'review'                    =>  $this->review,
            'status'                    =>  $this->status,
            'rating'                    =>  $this->rating,
        ]);
        
        update_review( $this->model, $this->model_id, $this->data_id );
        $this->dispatch('alert', ['type' => 'success',  'message' => 'Review Updated Successfully.' ]);
        $this->closeModal();
    }

    public function changeStatus($id, $status){
        $message = changeStatus('reviews', 'status', $id, $status);

        $check              =   Review::where( 'id', decode( $id ) )->first();
        update_review( $check->model, $check->model_id, $check->id );

        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    public function closeModal(){ $this->resetInputFields(); }
    private function resetInputFields(){
        $this->data_id                  =   null;
        $this->model                    =   null;
        $this->model_name               =   null;
        $this->model_id                 =   null;
        $this->rating                   =   null;
        $this->review                   =   null;
        $this->status                   =   null;
        $this->isOpen                   =   false;
    }
}
