<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Admin\Models\Adminsetting;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'iframe', 'status'];
    
    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%')
        ->orWhere('iframe', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }

    public function categoryName(){ return $this->hasOne(Adminsetting::class, 'id', 'category_id'); }
}