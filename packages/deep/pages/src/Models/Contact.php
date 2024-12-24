<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'name', 'email', 'phone', 'message', 'subject_id' ];
    
    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%')
        ->Orwhere('email', 'like', '%'.$val.'%')
        ->Orwhere('message', 'like', '%'.$val.'%');
    }
}
