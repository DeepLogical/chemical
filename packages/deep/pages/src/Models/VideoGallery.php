<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $fillable = [ 'model', 'model_id', 'url', 'status', 'display_order' ];

    public function scopeSearch($query, $val){
        return $query->where('url', 'LIKE', '%' . $val . '%');
    }

    public function scopeActive($query){ return $query->orderBy('display_order', 'ASC')->where('status', 1); }
}
