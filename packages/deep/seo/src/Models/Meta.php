<?php

namespace Deep\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Seo\Models\Meta as MetaModal;
use Deep\Blogs\Models\Blog;
use Deep\Blogs\Models\Blogmeta;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Media;

class Meta extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }
    
    protected $fillable = [ 'url', 'title', 'description', 'media_id' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('url', 'like', '%'.$val.'%');
    }

    public static function metatag(){
        $meta = null;
        $site = env('APP_URL');
        $url = cleanURL( url()->current() );
        
        $meta_url = str_replace([ '/news/', '/news-tag/', '/news-category/', '/product-type/', '/questions/', '/' ], '', $url);
        
        if(!$meta_url){ $meta_url = '/'; }

        $meta = MetaModal::where('url', $meta_url)->first();
        $img = []; $image = null;
        
        if( $meta ){
            $meta['image']                      =   optional($meta->media)->path ? optional($meta->media)->path : "/images/logo.png";
            if( optional($meta->page)->preload ){
                foreach( optional($meta->page)->preload->toArray() as $i ){
                    array_push( $img, $i['image'] );
                }
            }
            $meta   =   $meta->toArray();
            
            $meta['preload']                    =   $img;
        }else{
            $meta['title']                      =   config('deep.brand');
            $meta['description']                =   config('deep.brand');
            $meta['image']                      =   "/images/logo.png";
            $meta['preload']                    =   [];
        }
        $meta['url']                        =   $url;
        return $meta;
    }

    public function page(){ return $this->hasOne(Pages::class, 'url', 'url'); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}