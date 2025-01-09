<?php

namespace Deep\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Deep\Products\Models\ProductRequest;
use Deep\Products\Models\Product;

class ProductRequest extends Model
{
    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }
     

    protected $fillable = [ 'user_id', 'name', 'email', 'phone', 'location', 'company', 'product_id', 'quantity', 'message','status', 'admin_remarks' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('phone', 'like', '%'.$val.'%')
        ->Orwhere('name', 'like', '%'.$val.'%');
    }

    public function product(){ return $this->hasOne(Product::class, 'id', 'product_id'); }


}