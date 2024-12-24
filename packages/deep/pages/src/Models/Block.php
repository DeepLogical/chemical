<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [ 'type', 'data_id', 'media_id', 'text', 'status' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function media(){ return $this->belongsTo(Media::class); }
}