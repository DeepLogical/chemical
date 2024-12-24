<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [ 'media', 'alt', 'path', 'wp_id', 'wp_src' , 'new_media', 'wp_status', 'wp_media'];
    
    public function scopeSearch($query, $val){
        return $query
        ->where('media', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
}