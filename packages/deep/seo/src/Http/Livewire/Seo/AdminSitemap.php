<?php

namespace Deep\Seo\Http\Livewire\Seo;

use Livewire\Component;

use File;
use Deep\Blogs\Models\Blog;
use Deep\Pages\Models\Pages;
use Deep\Blogs\Models\Blogmeta;

class AdminSitemap extends Component
{
    public $blogs, $pages, $images, $blogMeta;

    public function mount(){
        $this->pages                =   Pages::active()->where([ ['sitemap', 1], ['url', '!=', '/'] ])->select('url')->get();
        $this->blogs                =   Blog::select('url')->get();
        $this->blogMeta             =   Blogmeta::select('type','url')->get();
    }

    public function render(){ return view('deep::livewire.seo.admin-sitemap')->layout('layouts.admin'); }

    public function createPageSitemap($data){
        $file = 'sitemap.xml';
        $destinationPath = public_path($file);
        
        $data = str_replace(["&lt;", "&gt;", " "], ["<", ">", ""], strip_tags($data));

        $data = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'.$data;
        $data = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $data);
        File::put($destinationPath,$data);
        $this->dispatch('alert', ['type' => 'success',  'message' => 'Sitemap Generated' ]);
    }

    public function createImageSitemap($data){
        $file = 'sitemap-image.xml';
        $destinationPath = public_path($file);

        $data = str_replace(["&lt;", "&gt;", " "], ["<", ">", ""], strip_tags($data));
        $data = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'.$data;
        $data = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $data);
        File::put($destinationPath,$data);
        $this->dispatch('alert', ['type' => 'success',  'message' => 'Sitemap Generated' ]);
    }
}