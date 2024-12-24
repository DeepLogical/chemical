<?php

namespace Deep\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'value', 'status'];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function typeName(){ return $this->hasOne(AdminSetting::class, 'id', 'type'); }
}