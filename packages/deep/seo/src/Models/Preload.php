<?php

namespace Deep\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preload extends Model
{
    use HasFactory;

    protected $fillable = [ 'page_id', 'image' ];
}