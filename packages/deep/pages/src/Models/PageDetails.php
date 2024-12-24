<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class PageDetails extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    protected $fillable = [ 'model', 'model_id', 'page_id', 'faq_title', 'faq_text', 'testimonial_media_id', 'testimonial_title', 'testimonial_text', 'blog_heading', 'blog_text', 'contact_heading', 'contact_text' ];

    public function scopeSearch($query, $val){
        return $query
        ->whereHas('page', function ($query2) use($val){
            $query2->where('name', 'LIKE', '%' . $val . '%')
                    ->orWhere('url', 'LIKE', '%' . $val . '%');
        });
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    // public function page(){ return $this->hasOne(Pages::class, 'id', 'model_id'); }
    public function media_testimonial(){ return $this->hasOne(Media::class, 'id', 'testimonial_media_id'); }
}
