<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'content',
        'image',
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
}
