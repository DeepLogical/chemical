<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Media;

class Team extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    protected $fillable = [ 'name', 'designation', 'media_id', 'status', 'text' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function media(){ return $this->hasOne(Media::class, 'id', 'media_id'); }
}