<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class Awards extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'media_id', 'status' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }

    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}
