<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Pages\Models\Pages;

class Faq extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }

    protected $fillable = [ 'model', 'model_id', 'quest', 'ans', 'status', 'display_order' ];

    public function scopeSearch($query, $val){
        return $query
        ->whereHas('page', function ($query2) use($val){
            $query2->where('name', 'LIKE', '%' . $val . '%')
                    ->orWhere('url', 'LIKE', '%' . $val . '%');
        });
    }

    public function scopeActive($query){ return $query->orderBy('display_order', 'DESC')->where('status', 1); }
    public function page(){ return $this->hasOne(Pages::class, 'id', 'model_id'); }
}