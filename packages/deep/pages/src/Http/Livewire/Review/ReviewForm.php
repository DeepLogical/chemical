<?php

namespace Deep\Pages\Http\Livewire\Review;

use Livewire\Component;

use DB;
use Auth;
use Deep\Pages\Models\Review;
use Deep\Pages\Models\MediaReview;
use Deep\Ecom\Models\Product;
use Deep\Medical\Models\Therapist;
use Livewire\WithFileUploads;

class ReviewForm extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $model, $model_id, $review, $star, $reviews, $images_upload = [], $star_ratings = [], $star_selected, $starred_reviews = [], $image_reviews = [], $old_review, $active_review, $data, $active_key;

    public function mount(){        
        $this->getReview();
    }

    public function render(){ return view('deep::livewire.review.review-form'); }

    public function stars($star){ $this->star = $star; }

    public function submit(){
        if( !$this->star ){ $this->dispatch('alert', ['type' => 'error',  'message' => 'Please provide rating' ]); return; }

        $this->validate([
            'review' => 'required',
        ]);

        DB::transaction(function () {
            $entry = Review::updateOrCreate([
                    'model'                 =>  $this->model,
                    'model_id'              =>  $this->model_id,
                    'user_id'               =>  Auth::user()->id
                ], [
                    'model'                 =>  $this->model,
                    'model_id'              =>  $this->model_id,
                    'user_id'               =>  Auth::user()->id,
                    'review'                =>  $this->review,
                    'rating'                =>  $this->star,
                    'status'                =>  0,
            ]);

            if( $this->images_upload && count($this->images_upload) ){
                $mediaArray = addMultipleImages( $this->images_upload, "review", optional($this->data)->name );
                if( $mediaArray && count($mediaArray) ){
                    foreach( $mediaArray as $i ){
                        MediaReview::create([
                            'model'                     =>  $this->model,
                            'model_id'                  =>  $this->model_id,
                            'user_id'                   =>  Auth::user()->id,
                            'review_id'                 =>  $entry->id,
                            'media_id'                  =>  $i,
                            'status'                    =>  1,
                            'created_at'                =>  now(),
                            'updated_at'                =>  now(),
                        ]);
                    }
                }
            }
        }, 3);

        $this->dispatch('reviewSubmitted');
        $this->getReview();

        $this->dispatch('alert', ['type' => 'success',  'message' => 'Review submitted for approval.']);
        return redirect(route('thankyou') );
    }

    private function getReview(){
        if( !Auth::check() ){ return; }

        $this->old_review = Review::where([ [ 'model', $this->model], [ 'model_id', $this->model_id], [ 'user_id', Auth::user()->id ] ])->first();
        if( $this->old_review ){
            $this->star = $this->old_review->rating;
            $this->review = $this->old_review->review;
        }

        $this->reviews          =   Review::where([ [ 'model', $this->model], [ 'model_id', $this->model_id] ])->active()->get();

        $this->image_reviews    =   MediaReview::where([ [ 'model', $this->model], [ 'model_id', $this->model_id] ])->active()->get();

        if( $this->reviews && count( $this->reviews ) ){
            $totalReviews = $this->reviews->count();

            $starCounts = $this->reviews->groupBy('rating')->map->count();
            $this->star_ratings = $starCounts->map(function ($count) use ($totalReviews) {
                return ($totalReviews > 0) ? round(($count / $totalReviews) * 100) : 0;
            });
        }

        $this->starred_reviews          =   $this->reviews;
    }

    public function change_star( $star ){
        $this->star_selected        =   $star;
        $this->starred_reviews      =   Review::where([ [ 'model', $this->model], [ 'model_id', $this->model_id], [ 'rating', $this->star_selected ] ])->active()->get();
    }

    public function openReviewModal( $id ){
        $this->isOpen = 1;

        $data = $this->image_reviews->toArray();
        $this->active_key  = array_search($id, array_column($data, "id") );
        $this->updatedActiveKey();
    }

    private function updatedActiveKey(){
        $this->active_review       = $this->image_reviews[$this->active_key] ?? null;
    }

    public function closeModal(){ $this->isOpen = 0; }

    public function leftActive(){
        $this->active_key = $this->active_key ? $this->active_key - 1 : count($this->image_reviews) - 1;
        $this->updatedActiveKey();
    }

    public function rightActive(){
        $this->active_key = $this->active_key != count($this->image_reviews) - 1 ? $this->active_key + 1 : 0;
        $this->updatedActiveKey();
    }

    private function getModeldata(){
        if( $this->model == "Product" ){
            $this->data                  =   Product::where('id', $this->model_id)->first();
        }

        if( $this->model == "Therapist" ){
            $this->data                  =   Therapist::where('id', $this->model_id)->first();
        }
    }

    protected $listeners = [ 'openReviewModal' ];
}