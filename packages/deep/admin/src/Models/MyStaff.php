<?php

namespace Deep\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class MyStaff extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'staff_id', 'status' ];

    public function scopeSearch($q, $val){
        return $q
        ->where('status', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function user(){ return $this->belongsTo(User::class); }
    public function staff(){ return $this->hasOne(User::class, 'id', 'staff_id'); }
}