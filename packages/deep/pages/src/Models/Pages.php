<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Seo\Models\Meta;
use Deep\Pages\Models\Media;
use Deep\Pages\Models\Pages as PageModel;
use Deep\Pages\Models\Faq;
use Deep\Pages\Models\Testimonial;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Pages extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('url')
            ->saveSlugsTo('url');
    }

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    protected $fillable = [ 'name', 'url', 'model', 'media_id', 'sitemap', 'schema', 'status', 'text' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('url', 'like', '%'.$val.'%')
        ->Orwhere('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    
    public function meta(){ return $this->hasOne(Meta::class, 'url', 'url'); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
    public function faq(){ return $this->hasMany(Faq::class, 'model_id', 'id')->where('model', 'Page')->active(); }
    public function testis(){ return $this->hasMany(Testimonial::class, 'model_id', 'id')->where('model', 'Page')->orderBy('id', 'DESC')->active(); }
    public function achievement(){ return $this->hasMany(Achievement::class, 'model_id', 'id')->active(); }
    public function banner(){ return $this->hasMany(Banner::class, 'model_id', 'id')->active(); }
    public function details(){ return $this->hasOne(PageDetails::class, 'model_id', 'id'); }
}