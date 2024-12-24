<?php

namespace Deep\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [ 'model_type', 'model_id', 'user_id', 'changes' ];

    public function scopeSearch($query, $val){
        return $query
        ->where('model_type', 'like', '%'.$val.'%');
    }

    public function user(){ return $this->hasOne(User::class, 'id', 'user_id'); }
}