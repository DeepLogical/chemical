<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Subscribe extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'email', 'status' ];
    
    public function scopeSearch($query, $val){
        return $query
        ->where('email', 'like', '%'.$val.'%')
        ->Orwhere('status', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function user(){ return $this->belongsTo(User::class); }
}
