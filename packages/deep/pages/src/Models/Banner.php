<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class Banner extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    protected $fillable = [ 'model', 'model_id',  'heading', 'url', 'text', 'media_id', 'mobile_media_id', 'status', 'display_order' ];

    public function scopeSearch($query, $val){
        return $query
        ->whereHas('page', function ($query2) use($val){
            $query2->where('name', 'LIKE', '%' . $val . '%')
                    ->orWhere('url', 'LIKE', '%' . $val . '%');
        });
    }

    public function scopeActive($query){ return $query->where('status', 1)->orderBy('display_order', 'ASC'); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
    public function mobile_media(){ return $this->hasOne(Media::class, 'id', 'mobile_media_id'); }
    public function page(){ return $this->hasOne(Pages::class, 'id', 'model_id'); }
}