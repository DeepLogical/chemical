<?php

namespace Deep\Pages\Http\Livewire\Faq;

use Livewire\Component;

use DB;
use Deep\Blogs\Models\Blog;
use Deep\News\Models\News;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Faq;
use Livewire\WithPagination;

class AddUpdateFaq extends Component
{
    use WithPagination;
    
    public $model, $model_id, $name, $data;

    public function mount( $model, $id ){
        $this->model_id = decode( $id );
        $this->initData();
        $this->getData();
    }

    public function render(){ return view('deep::livewire.faq.add-update-faq')->layout('layouts.admin'); }

    private function getData(){
        $this->data                 =   Faq::where([ ['model', $this->model], ['model_id', $this->model_id] ])->get();
    }

    private function initData(){
        if( $this->model == "Blog" ){
            $this->data                 =   Blog::select('id', 'name', 'url')->where("id", $this->model_id)->first();
        }

        if( $this->model == "Page" ){
            $this->data                 =   Pages::select('id', 'name', 'url')->where("id", $this->model_id)->first();
        }

        if( $this->model == "News" ){
            $this->data                 =   News::select('id', 'name', 'url')->where("id", $this->model_id)->first();
        }

        if( ! $this->data ){ return redirect( route('404') ); }
        $this->name                 =   $this->data->name;
    }
    protected $listeners = [ 'searchUpdated', 'perPageUpdated', 'openModalCalled', 'faqModalUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->dispatch('openFaqModal'); }
    public function faqModalUpdated(){ $this->getData(); }
}