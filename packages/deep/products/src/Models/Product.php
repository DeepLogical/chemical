<?php

namespace Deep\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Deep\Pages\Models\Media;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Comments;

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

    protected $fillable = ['name','manufacturer','functions','end','tds','url','media_id','status'];

    public function scopeSearch($query, $val){
        return $query
        ->where('url', 'like', '%'.$val.'%')
        ->Orwhere('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function media(){ return $this->belongsTo(Media::class); }
    public function services(){ return $this->belongsToMany(Pages::class); }
    public function comments(){ return $this->hasMany(Comments::class, 'page_id', 'id')->where([ ['status', 1], ['c_order', 0], ['type', 'Product'] ]); }

}
