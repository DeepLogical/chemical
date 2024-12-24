<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Pages;

use Deep\Pages\Models\Media;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [ 'model', 'model_id', 'name', 'value', 'media_id', 'status' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }

    public function page(){ return $this->hasOne(Pages::class, 'id', 'model_id'); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}