<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'name', 'email', 'phone', 'resume', 'cover', 'subject', 'message', 'status', 'admin_remarks' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('name', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where( 'status', 'requested' ); }
}
