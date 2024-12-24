<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\PageDetails;
use Deep\Blogs\Models\Blog;
use Deep\Pages\Models\AgendaBlog;
use Deep\Seo\Models\Preload;

use Livewire\WithFileUploads;

class AddUpdatePage extends Component
{
    use WithFileUploads;

    public $name, $url, $model, $model_id, $sitemap = 1, $schema = 1, $status = 1, $text,$image, $media_id, $old_image, $data_id, $images = [];
    public $title, $description, $meta_id;
    public $faq_title, $faq_text, $testimonial_title, $testimonial_text, $testis_cover, $testimonial_media_id, $old_testis_cover, $blogOptions  = [];

    public $blog_heading, $blog_text, $contact_heading, $contact_text;

    public function mount($id = null){
        if( $id ){
            $this->data                     =   Pages::where('id', decode($id))->first();
            if( !$this->data ){ return redirect(route('404') ); }

            $this->data_id                  =   $this->data->id;
            $this->name                     =   $this->data->name;
            $this->url                      =   $this->data->url;
            $this->model                    =   $this->data->model;
            $this->model_id                 =   $this->data->model_id;
            $this->sitemap                  =   $this->data->sitemap;
            $this->schema                   =   $this->data->schema;
            $this->status                   =   $this->data->status;
            $this->text                     =   $this->data->text;
            
            $this->faq_title                =   optional($this->data->details)->faq_title;
            $this->faq_text                 =   optional($this->data->details)->faq_text;
            $this->testimonial_text         =   optional($this->data->details)->testimonial_text;
            $this->testimonial_title        =   optional($this->data->details)->testimonial_title;
            $this->testimonial_media_id     =   optional($this->data->details)->testimonial_media_id;
            $this->old_testis_cover         =   optional(optional($this->data->details)->media_testimonial)->path;

            $this->blog_heading             =   optional($this->data->details)->blog_heading;
            $this->blog_text                =   optional($this->data->details)->blog_text;
            $this->contact_heading          =   optional($this->data->details)->contact_heading;
            $this->contact_text             =   optional($this->data->details)->contact_text;
            $this->media_id                 =   optional($this->data->media)->id;
            $this->old_image                =   optional($this->data->media)->path;
            $this->meta_id                  =   optional($this->data->meta)->id;
            $this->title                    =   optional($this->data->meta)->title;
            $this->description              =   optional($this->data->meta)->description;

            if( $this->data->preload ){
                $xx = [];
                foreach( $this->data->preload as $i ){
                    $xx[]                   =   $i['image'];
                }
                $this->images               =   $xx;
            }
        }

        $this->blogOptions              =   Blog::select('id', 'name')->orderBy('name', 'ASC')->get();
    }

    public function render(){ return view('deep::livewire.admin.add-update-page')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'name'                      => 'required',
            'url'                       => 'required',
            'model'                     => 'required',
            'sitemap'                   => 'required',
            'schema'                    => 'required',
            'status'                    => 'required',
        ]);

        $url = $this->url == "/" ? $this->url : sanitizeURL( $this->url );

        if( !$this->data_id && Pages::where('url', $url)->exists() ){
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Duplicate Entry, please check' ]);
            return;
        }
        
        DB::transaction(function () use($url) {
            if($this->image){ $this->media_id = addOrUpdateSingleImage( $this->image, 'page', $this->name, $this->name, $this->media_id ); }
            if($this->testis_cover){ $this->testimonial_media_id = addOrUpdateSingleImage( $this->testis_cover, 'testimonials', $this->name, $this->name, $this->testimonial_media_id ); }

            $entry = Pages::updateOrCreate(['id' => $this->data_id], [
                'model'                             =>  $this->model,
                'model_id'                          =>  $this->model_id,
                'name'                              =>  $this->name,
                'url'                               =>  $url,
                'sitemap'                           =>  $this->sitemap,
                'schema'                            =>  $this->schema,
                'status'                            =>  $this->status,
                'text'                              =>  $this->text,
                'media_id'                          =>  $this->media_id
            ]);

            if ($this->model == 'Page' && is_null($this->model_id)) {
                $this->model_id = $entry->id;
                $entry->update(['model_id' => $this->model_id]);
            }

            PageDetails::updateOrCreate(['page_id' => $entry->id], [
                'page_id'                           =>  $entry->id,
                'model'                             =>  $this->model,
                'model_id'                          =>  $this->model_id,
                'faq_title'                         =>  $this->faq_title,
                'faq_text'                          =>  $this->faq_text,
                'testimonial_title'                 =>  $this->testimonial_title,
                'testimonial_text'                  =>  $this->testimonial_text,
                'testimonial_media_id'              =>  $this->testimonial_media_id,
                'blog_heading'                      =>  $this->blog_heading,
                'blog_text'                         =>  $this->blog_text,
                'contact_heading'                   =>  $this->contact_heading,
                'contact_text'                      =>  $this->contact_text            
            ]);

            Preload::where( 'page_id', $entry->id )->delete();
            foreach( $this->images as $i ){
                Preload::create([
                    "page_id"               =>  $entry->id,
                    "image"                 =>  $i
                ]);
            } 
            
            $check = Pages::select('url')->findOrFail($entry->id);
            if($check){
                addOrUpdateMeta( $check->url, $this->title, $this->description, $this->meta_id, $this->media_id );
            }

            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Pages Updated Successfully.' : 'Pages Created Successfully.' ]);
        }, 3);

        return redirect(route('adminPages') );
    }

    public function addimage(){ array_push($this->images, "" ); }
    public function removeimage($id){ array_splice($this->images, $id, 1); }
}