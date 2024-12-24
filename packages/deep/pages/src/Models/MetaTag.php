<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Deep\Seo\Models\Meta;

class MetaTag extends Model
{
    use HasFactory;

    use HasSlug;

    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('url')
            ->saveSlugsTo('url')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected $fillable = [ 'model', 'type', 'url', 'name', 'status' ];

    public function taggable(){ return $this->morphTo('taggable'); }
    
    public function scopeSearch($query, $val){
        return $query->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function meta(){ return $this->hasOne(Meta::class, 'url', 'url'); }
}