<?php

namespace Deep\Blogs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Deep\Seo\Models\Meta;
use Deep\Blogs\Models\Blog;
use Deep\Pages\Models\Media;

class Blogmeta extends Model
{
    use HasFactory;
    use HasSlug;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('url')
            ->saveSlugsTo('url')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected $fillable = [ 'url', 'type', 'name', 'media_id' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('blogmetas.url', 'like', '%'.$val.'%')
        ->Orwhere('blogmetas.type', 'like', '%'.$val.'%')
        ->Orwhere('blogmetas.name', 'like', '%'.$val.'%');
    }

    public function meta(){ return $this->hasOne(Meta::class, 'url', 'url'); }
    public function blogs( $search = null ){         
        return 
         $this->belongsToMany(Blog::class)->where('name', 'like', '%' . $search . '%')->active(); 
    }
    public function media(){ return $this->belongsTo(Media::class); }
}