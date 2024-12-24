<?php

namespace Deep\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaInterface extends Model
{
    use HasFactory;

    protected $fillable = [ 'batch_no', 'user_id', 'url', 'title', 'description', 'status', 'message' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('url', 'like', '%'.$val.'%');
    }
}
