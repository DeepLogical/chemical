<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Deep\Ecom\Models\Product;

class Review extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::updating(function ($model) {
            createAuditLog($model);
        });
    }
    
    protected $fillable = [ 'model', 'model_id', 'user_id', 'review', 'rating', 'status' ];

    public function scopeSearch($q, $val){
        return $q
        ->where('review', 'like', '%'.$val.'%');
    }

    public function scopeActive($query){ return $query->where('status', 1); }
    public function scopeDateSpecific($query, $date){ return dateSpecific($query, $date); }
    public function scopeDateRange($query, $from, $to){ return dateRange($query, $from, $to); }

    public function product(){ return $this->hasOne(Product::class, 'id', 'model_id'); }
    public function user(){ return $this->belongsTo(User::class); }
    public function media(){ return $this->hasMany(MediaReview::class); }
}