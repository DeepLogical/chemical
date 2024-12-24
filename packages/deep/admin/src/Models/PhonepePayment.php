<?php

namespace Deep\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonepePayment extends Model
{
    use HasFactory;

    protected $fillable = [ 'model', 'model_id', 'amount', 'data', 'transaction_id' ];

    public function scopeSearch($q, $val){
        return $q
        ->where('model', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query; }
}
