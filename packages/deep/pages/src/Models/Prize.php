<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = [ 'model', 'model_id', 'media_id', 'rank', 'prize', 'status', 'display_order' ];

    public function scopeSearch($query, $val){
        return $query->where('rank', 'LIKE', '%' . $val . '%');
    }

    public function scopeActive($query){ return $query->orderBy('display_order', 'ASC')->where('status', 1); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}