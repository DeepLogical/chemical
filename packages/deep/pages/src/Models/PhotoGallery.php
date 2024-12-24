<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Admin\Models\Adminsetting;

class PhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'media_id', 'status', 'name'];
    
    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }

    public function categoryName(){ return $this->hasOne(Adminsetting::class, 'id', 'category_id'); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}