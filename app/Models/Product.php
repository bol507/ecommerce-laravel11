<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function favorites () {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
