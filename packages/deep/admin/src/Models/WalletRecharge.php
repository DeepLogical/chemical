<?php

namespace Deep\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class WalletRecharge extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'payment_id', 'paymode', 'amount' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('user_id', 'like', '%'.$val.'%');
    }

    public function scopeMine($query){ return mine($query); }

    public function user(){ return $this->hasOne(User::class, 'id', 'user_id'); }
}