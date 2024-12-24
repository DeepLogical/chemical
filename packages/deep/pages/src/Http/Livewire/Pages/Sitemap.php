<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Blogs\Models\Blog;
use Deep\Blogs\Models\Blogmeta;
use Deep\Pages\Models\Pages;

class Sitemap extends Component
{
    public $data, $cat, $tag;
    public $pages =[];
    public $services =[];
    public $regions = [ ];    
    public $tech = [];
    public $portfolio = [];
    public $social = [];

    public function mount(){
        $this->social = config('deep.social');
        $this->regions =   Pages::select('region')->whereNotNull('region')->with('regionalPages:region,name,url,type')->distinct()->get();
        $this->pages =   Pages::where([ ['status', 1], ['type', 'Static'], ['url', '!=', '/'] ])->select('name', 'url')->orderBy('id', 'desc')->get();
        $this->portfolio =   Pages::where([ ['status', 1], ['sitemap', 1], ['type', 'Portfolio'] ])->select('name', 'url')->orderBy('id', 'desc')->get();
        $this->services =   Pages::where([ ['status', 1], ['sitemap', 1], ['type', 'service'] ])->select('name', 'url')->orderBy('id', 'desc')->get();
        $this->tech =   Pages::where([ ['status', 1], ['sitemap', 1], ['type', 'Language'] ])->select('name', 'url')->orderBy('id', 'desc')->get();
        $this->data =   Blog::select('name', 'url')->orderBy('id', 'desc')->get();
        $this->cat = Blogmeta::select('name', 'url')->where('type', 'category')->get();
        $this->tag = Blogmeta::select('name', 'url')->where('type', 'tag')->get();       
    }

    public function render(){ return view('deep::livewire.pages.sitemap')->layout('layouts.guest'); }
}