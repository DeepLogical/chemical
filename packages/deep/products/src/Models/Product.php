<?php

namespace Deep\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Deep\Seo\Models\Meta;
use Deep\Pages\Models\Media;
use Deep\Products\Models\Productmeta;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('url')
            ->saveSlugsTo('url')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    
    public function scopeActive($query){ return $query->where('status', 1); }

     protected $fillable = [  'name', 'manufacturer', 'functions', 'end', 'tds', 'url', 'media_id', 'status' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('url', 'like', '%'.$val.'%')
        ->Orwhere('name', 'like', '%'.$val.'%');
    }

    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
    public function tag(){ return $this->belongsToMany(Productmeta::class)->where('type', 'tag'); }
    public function category(){ return $this->belongsToMany(Productmeta::class)->where('type', 'category'); }
    public function meta(){ return $this->hasOne(Meta::class, 'url', 'url'); }
    public function comments(){ return $this->hasMany(Comments::class, 'page_id', 'id')->where([ ['status', 1], ['c_order', 0], ['type', 'Product'] ]); }
    public function productmeta(){ return $this->belongsToMany(Productmeta::class); }
    public function services(){ return $this->belongsToMany(Pages::class); }
    public function faq(){ return $this->hasMany(Faq::class, 'model_id', 'id')->where('model', 'Product')->active(); }

}