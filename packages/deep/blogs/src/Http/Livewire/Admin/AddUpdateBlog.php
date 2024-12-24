<?php

namespace Deep\Blogs\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Auth;
use Deep\Blogs\Models\Blog;
use Deep\Pages\Models\Pages;
use Deep\Blogs\Models\Blogmeta;
use Deep\Blogs\Models\Author;
use Livewire\WithFileUploads;

class AddUpdateBlog extends Component
{
    use WithFileUploads;

    public $name, $url, $image, $old_image, $content, $excerpt, $title, $description, $meta_id, $author_id, $media_id, $data_id;

    public $tagSelected = [], $tagOptions = [], $catSelected = [], $catOptions = [], $authorOptions = [];

    public function mount( $id = null ){
        if( $id ){
            $this->data_id              =   decode($id);
            $data                       =   Blog::find( $this->data_id );

            if( !$data ){ return redirect( route('404') ); }

            $this->name                 =   $data->name;
            $this->url                  =   $data->url;
            $this->content              =   $data->content;
            $this->excerpt              =   $data->excerpt;
            $this->author_id            =   $data->author_id;
            $this->media_id             =   optional($data->media)->id;
            $this->meta_id              =   optional($data->meta)->id;
            $this->title                =   optional($data->meta)->title;
            $this->description          =   optional($data->meta)->description;
            $this->old_image            =   optional($data->media)->path;

            $catArray = []; $tagArray = [];
            foreach( $data->blogmeta as $i ){
                if($i->type === "category"){ array_push( $catArray, $i->id ); }
                if($i->type === "tag"){ array_push( $tagArray, $i->id ); }
            }
            $this->catSelected = $catArray;
            $this->tagSelected = $tagArray;
        }

        $this->catOptions               =   Blogmeta::select('id', 'name')->where('type', 'category')->get();
        $this->tagOptions               =   Blogmeta::select('id', 'name')->where('type', 'tag')->get();
        $this->authorOptions            =   Author::active()->get();
    }

    public function render(){ return view('deep::livewire.admin.add-update-blog')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'name'                      =>  'required',
            'url'                       =>  'required',
            'content'                   =>  'required',
            'excerpt'                   =>  'required',
            'title'                     =>  'required',
            'description'               =>  'required',          
        ]);

        // dd("GO");

        if( !$this->media_id ){
            $this->validate([
                'image'                 => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            $url = sanitizeURL($this->url);

            if( $this->image ){
                $this->media_id = addOrUpdateSingleImage($this->image, 'blog', $this->name, $url, $this->media_id );
            }

            $data = Blog::updateOrCreate(['id' => $this->data_id], [
                'name'                  =>  $this->name,
                'url'                   =>  $url,
                'content'               =>  $this->content,
                'excerpt'               =>  $this->excerpt,
                'media_id'              =>  $this->media_id,
                'status'                =>  1,
                'author_id'             =>  $this->author_id,
            ]);

            $blogMeta = []; 
            foreach($this->catSelected as $i){ array_push($blogMeta, (int)$i); }
            foreach($this->tagSelected as $i){ array_push($blogMeta, (int)$i); }
            
            $blogMeta = array_merge($this->catSelected, $this->tagSelected);
            pivotEntry('blog_blogmeta', $data->id, $blogMeta, 'blog_id', 'blogmeta_id');

            $check = Blog::select('url')->findOrFail($data->id);
            if($check){
                addOrUpdateMeta( $check->url, $this->title, $this->description, $this->meta_id, $this->media_id );
            }

            $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Blog Updated Successfully.' : 'Blog Created Successfully.' ]);
        }, 3);

        return redirect(route('adminBlog') );
    }
}