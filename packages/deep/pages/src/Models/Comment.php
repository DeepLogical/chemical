<?php

namespace Deep\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Deep\Blogs\Models\Blog;
use Deep\News\Models\News;
use Deep\Quora\Models\Quora;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [ 'model', 'model_id', 'c_order', 'comment_id', 'user_id', 'name', 'email', 'comment', 'status' ];

    public function scopeSearch($query, $val){
        return $query->where('model', 'LIKE', '%' . $val . '%');
    }

    public function scopeActive($query){ return $query->orderBy('id', 'DESC')->where('status', 1); }
    public function blog(){ return $this->belongsTo(Blog::class, 'model_id'); }
    public function news(){ return $this->belongsTo(News::class, 'model_id'); }
    public function quora(){ return $this->belongsTo(Quora::class, 'model_id'); }
    public function response(){ return $this->hasMany(Comment::class, 'comment_id', 'id')->active()->where([ ['c_order', 1] ]); } 
}